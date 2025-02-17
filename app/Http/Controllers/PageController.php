<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserReferral;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function showUnpaidUsers()
    {
        $unpaidUsers = User::join('referral_mapping', 'users.user_id', '=', 'referral_mapping.user_id')
                            ->select('users.*', 'referral_mapping.referral_code as mapped_referral_code') 
                            // ->where('users.is_paid', 'N')
                            // ->where('users.is_admin', 'N')
                            ->get();

        // $unpaidUsers = UserReferral::join('users', 'users.user_id', '=', 'referral_mapping.user_id')
        // ->select('referral_mapping.*, users.user_id, ') 
        // ->get();
        // // dd($unpaidUsers);

        return view('contents.approval', compact('unpaidUsers'));
    }
}