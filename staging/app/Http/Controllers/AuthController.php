<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserReferral;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\SendWelcomeEmail;
use App\Mail\ResetPasswordMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PasswordResetToken;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {

        // dd($request->all());

        $credentials = $request->validate([
            'user_id' => 'required|string',
            'password' => 'required|string'
        ]);


        // Cek kredensial login
        if (Auth::attempt(['user_id' => $credentials['user_id'], 'password' => $credentials['password']])) {
            return redirect()->route('index')->with('success', 'Login berhasil!');
        }

        // Jika gagal, kembali ke halaman login dengan pesan error
        return redirect()->route('login')->with('error', 'User ID atau password salah.');
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }

    // public function register($referral_code = null)
    // {
    //     $isReferralFromUrl = false;

    //     if($referral_code && User::where('referral_code', $referral_code)->exists()){
    //         $isReferralFromUrl = true;
    //     }
    //     return view('auth.register', [
    //         'referral_code' => $referral_code,
    //         'isReferralFromUrl' => $isReferralFromUrl
    //     ]);
    // }
    public function register($referral_code = null)
    {
        // Jika referral code kosong atau tidak ditemukan di database, redirect ke login
        if (!$referral_code || !User::where('referral_code', $referral_code)->exists()) {
            return redirect()->route('login')->with('error', 'Referral tidak ditemukan.');
        }

        return view('auth.register', [
            'referral_code' => $referral_code,
            'isReferralFromUrl' => true
        ]);
    }

    public function store(Request $request)
    {


        // dd($request->all());

        // Validasi input
        $request->validate([
            'user_id'      => 'required|string|unique:users,user_id',
            'password'     => 'required|string|min:6|confirmed',
            'nama'         => 'required|string|max:255',
            'nik'          => 'required|digits:16|unique:users,nik', // Perbaikan: gunakan `digits:16`
            'wa_number'    => 'required|numeric|digits_between:10,15', // Perbaikan: angka saja
            'email'        => 'required|string|email|max:255|unique:users,email',
            'bank_name'    => 'nullable|string|max:100',
            'acc_number'   => 'nullable|numeric|digits_between:5,20', // Perbaikan: gunakan `digits_between`
            'acc_name'     => 'nullable|string|max:255',
            'referral_code'=> 'nullable|string'
        ]);
        

        // dd($request->referral_code);

        

        // Generate Referral Code (10 karakter alfanumerik)
        // $referralCode = $request->referral_code ?? Str::upper(Str::random(10));
        $referralCode = Str::upper(Str::random(10));
        // $generatedReferralCode = $referralCode ?? Str::upper(Str::random(10));

        // $referrer = User::where('referral_code', $request->referral_code)->first();

        $availableReferrer = $this->findAvailableReferrer($request->referral_code);
        
        // dd($availableReferrer);
        
        DB::beginTransaction();

        try{

            $user = User::create([
                'user_id'      => $request->user_id,
                'password'     => Hash::make($request->password),
                'referral_code'=> $referralCode,
                'is_admin'     => 'N',
                'is_paid'      => 'N',
                'nama'         => $request->nama,
                'nik'          => $request->nik,
                'wa_number'    => $request->wa_number,
                'email'        => $request->email,
                'bank_name'    => $request->bank_name,
                'acc_number'   => $request->acc_number,
                'acc_name'     => $request->acc_name,
            ]);
            $userReferral = UserReferral::create([
                'user_id'      => $request->user_id,
                'referral_code'=> $availableReferrer->referral_code,
            ]);

            DB::commit();
            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan cek email.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        // Simpan data ke database

            

        // Kirim email selamat datang
        $details = [
            'name' => $user->nama,
            'email' => $user->email
        ];

        // Mail::to($user->email)->send(new SendWelcomeEmail($details));

        // Redirect dengan pesan sukses
        
    }

    private function findAvailableReferrer($referrerCode)
    {
        $referralCount = UserReferral::where('referral_code', $referrerCode)->count();

        if ($referralCount < 10) {
            return User::where('referral_code', $referrerCode)->first();
        }

        $oldestReferrer = User::join('referral_mapping as rm', 'rm.referral_code', '=', 'users.referral_code')
                            ->join('users as u2', 'u2.user_id', '=', 'rm.user_id')
                            ->where('rm.referral_code', $referrerCode)
                            ->orderBy('u2.created', 'asc')
                            ->first();

        if ($oldestReferrer) {
            return $this->findAvailableReferrer($oldestReferrer->referral_code);
        }

        return null;
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'user_id'   => 'required|string|exists:users,user_id',
        ]);

        $user = User::where('user_id', $request->user_id)->first();

        PasswordResetToken::where('user_id', $user->user_id)->delete();

        $token = bin2hex(random_bytes(32));

        PasswordResetToken::create([
            'user_id'   => $user->user_id,
            'email'     => $user->email,
            'token'     => Hash::make($token),
            'created_at'=> now(),
        ]);

        $resetUrl = url('/reset-password?token=' . $token . '&email=' . $user->email . '&user_id=' . $user->user_id);
        $userName = $user->nama;

        Mail::to($user->email)->send(new ResetPasswordMail($resetUrl, $userName));

        return back()->with('success', 'Email reset password telah dikirim.');

    }

    public function showResetForm()
    {
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string|exists:users,user_id',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
            'token' => 'required'
        ]);

        $reset = PasswordResetToken::where('user_id', $request->user_id)
                                    ->where('email', $request->email)                           
                                    ->first();

        if (!$reset || !Hash::check($request->token, $reset->token)) {
            return back()->withErrors(['token' => 'Token tidak valid atau sudah kedaluwarsa.']);
        }

        $user = User::where('user_id', $request->user_id)
                    ->where('email', $request->email)
                    ->first();
        $user->update(['password' => Hash::make($request->password)]);

        $reset->delete();

        return redirect('/login')->with('success', 'Password berhasil direset.');
    }
}
