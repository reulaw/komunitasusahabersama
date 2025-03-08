<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserReferral;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                                ->select('rm.user_id as user_id', 'u2.nama as nama', 'u2.email as email', 'u2.created as created', 'u2.referral_code as referral_code',
                                'rm.referral_code as referred_code' )
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
                // $query->where('users.referral_code', $selectedReferral)
                //       ->orWhere('rm.referral_code', $selectedReferral);
                $treeUsers = DB::select('CALL GetReferralHierarchy(?)', [$selectedReferral]);
                return response()->json(collect($treeUsers));
            }
    
            $treeUsers = $query->get();
            return response()->json($treeUsers);
        }
    
        
    }
    

}