<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserReferral;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function index()
    {
        return view('contents.index');
    }

    public function showRegisteredUsers()
    {
        $user = Auth::user();

        if($user->is_admin == 'Y'){
            $registeredUsers = User::where('is_admin','N')
                                ->orderBy('created', 'desc')
                                ->get();
            
        } else{
            $registeredUsers = User::join('referral_mapping as rm', 'users.referral_code', '=', 'rm.referral_code')
                                ->join('users as u2', 'u2.user_id', '=', 'rm.user_id')
                                ->where('users.is_paid', 'Y')
                                ->where('users.is_admin','N')
                                ->where('users.user_id', $user->user_id)
                                ->select('rm.user_id as user_id', 'u2.nama as nama', 'u2.email as email', 'u2.created as created', 'rm.referral_code as referral_code' )
                                ->orderBy('rm.created', 'desc')
                                ->get();
        }

        return view('contents.report-registrations', compact('registeredUsers'));
    }

    public function showUsersDetails($referral_code)
    {

        // Auth::user();

        $details    = DB::select('CALL calculatePendapatan(?,?,?)', [$referral_code,NULL,NULL]);

        return response()->json($details);
    }

    public function showHierarchyPage()
    {
        $user = Auth::user();

        if ($user->is_admin == 'Y'){
            $allReferralCodes = User::pluck('nama', 'referral_code');
        } else{
            $allReferralCodes = User::where('user_id', $user->user_id)
                                    ->pluck('nama', 'referral_code');
        }
        

        return view('contents.org-chart', compact('allReferralCodes'));
    }

    public function referralHierarchy(Request $request)
    {
        $user = Auth::user();
        $selectedReferral = $request->input('referral_code', '');
    
        if ($user->is_admin == 'N') {
            // Ambil data dari stored procedure hanya jika user bukan admin
            $treeUsers = DB::select('CALL GetReferralHierarchy(?)', [$user->referral_code]);
            
            // Pastikan hasilnya dalam format koleksi Laravel
            // $treeUsers = collect($treeUsers);
            return response()->json(collect($treeUsers));
            
        } else {
            // Query untuk admin
            $query = User::leftJoin('referral_mapping as rm', 'users.user_id', '=', 'rm.user_id')
                ->select([
                    'users.user_id as user_id',
                    'users.nama as nama',
                    'users.referral_code as referral_code',
                    'rm.referral_code as referred_code'
                ]);
    
            if ($selectedReferral) {
                $query->where('users.referral_code', $selectedReferral)
                      ->orWhere('rm.referral_code', $selectedReferral);
            }
    
            $treeUsers = $query->get();
        }
    
        return response()->json($treeUsers);
    }
    
    public function showUserProfile()
    {
        $user = Auth::user();
        return view('contents.user-profile', compact('user'));
    }

    public function updateUser(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama'          => 'required|string',
            'waNumber'      => 'required|string',
            'accBankName'   => 'required|string',
            'accNumber'     => 'required|string',
            'accName'       => 'required|string',
            'email'         => 'required|email'
        ]);
        
        $user->update([
            'nama'      => $request->nama,
            'wa_number' => $request->waNumber,
            'bank_name' => $request->accBankName,
            'acc_number'=> $request->accNumber,
            'acc_name'  => $request->accName,
            'email'     => $request->email,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function changePassword(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'currentPassword' => ['required'],
                'newPassword' => ['required', 'min:8', 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            // Jika validasi gagal, tetap di tab "Change Password"
            return redirect()->back()
                             ->withErrors($e->validator)
                             ->with('active_tab', 'change-password-tab');
        }
    
        $user = Auth::user();
    
        if (!Hash::check($request->currentPassword, $user->password)) {
            return redirect()->back()
                             ->withErrors(['currentPassword' => 'Password lama tidak sesuai!'])
                             ->with('active_tab', 'change-password-tab');
        }
    
        $user->update(['password' => Hash::make($request->newPassword)]);
    
        return redirect()->back()
                         ->with('success', 'Password berhasil diperbarui!')
                         ->with('active_tab', 'change-password-tab');
    }

}