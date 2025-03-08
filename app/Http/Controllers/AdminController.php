<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TransferHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransferNotificationMail;
use Carbon\Carbon;

class AdminController extends Controller
{
    // Method untuk menampilkan daftar user yang perlu diapprove
    public function showPendingRegistrations()
    {
        // Ambil data user yang statusnya masih pending
        $users = User::where('is_paid', 'N')->orderBy('created', 'desc')->get();

        return view('admin.approve-registrations', compact('users'));
    }

    // Method untuk approve pendaftaran user
    public function approveRegistration($user_id)
    {
        // Cari user berdasarkan user_id
        $user = User::findOrFail($user_id);
        // dd($user->user_id);
        // Update status user menjadi approved
        $user->is_paid = 'Y';
        $user->save();

        DB::statement('CALL UpdatePendapatan(?)', [$user->user_id]);

        // Redirect ke halaman daftar user dengan pesan sukses
        return redirect()->route('list.registration')->with('success', 'User berhasil diapprove!');
    }

    
    public function commissions()
    {
        $userCommissions = User::where('is_paid', 'Y')
                            ->where('is_admin','N')
                            ->get();
        
        return view('admin.commissions', compact('userCommissions'));
    }

    public function commissionTransfer(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id'        => 'required|exists:users,id',
            'user_id'   => 'required|string',
            'amount'    => 'required|string',
            'bank_name' => 'required|string',
            'acc_number'=> 'required|string',
            'acc_name'  => 'required|string'
        ]);

        
        $user   = User::find($request->id);


        $amount = str_replace('.', '', $request->amount);
        $amount = (float) $amount;

        $pendapatanMengendap = $user->pendapatan_mengendap;

        if ($amount > $pendapatanMengendap) {
            return back()->with('error', 'Jumlah transfer tidak boleh lebih besar dari pendapatan mengendap!');
        }

        DB::beginTransaction();

        try{
            $user = User::where('id', $request->id)->lockForUpdate()->first();
            $user->pendapatan_mengendap     -= $amount;
            $user->pendapatan_sudah_dibayar += $amount;
            $user->save();

            $transferHistory = TransferHistory::create([
                'user_id'           => $request->user_id,
                'transfer_amount'   => $amount,
                'created_by'        => Auth::user()->user_id,
                'acc_name'          => $request->acc_name,
                'acc_number'        => $request->acc_number

            ]);       
        
            $userName       = $user->nama;
            $now            = Carbon::now();
            $userAccNumber  = $user->acc_number;
            $amountTransfer = $amount;

            // $userName   = "test";
            // $now = "293010203";
            // $userAccNumber = "8391284423";
            // $amountTransfer = 38294832;
            Mail::to($user->email)->send(new TransferNotificationMail($userName, $amountTransfer, $now, $userAccNumber));
            // Mail::to('abelaurens@gmail.com')->send(new TransferNotificationMail($userName, $amountTransfer, $now, $userAccNumber));
            DB::commit();
            return redirect()->back()->with('success', 'Transfer berhasil!');

        } catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }


        


        // $transferHistory = transferHistory::create([
        //     'user_id'   => $request
        // ])

       
    }

    public function showListUmroh()
    {
        $userUmroh = User::where('is_paid', 'Y')
                            ->where('is_admin','N')
                            ->where('pendapatan','>=','35000000')
                            ->get();
        return view('admin.list-umroh', compact('userUmroh'));
    }
}
