<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;
class CommonUserController extends Controller
{     public function __construct()
    {
        $this->middleware('auth');
    }


    public function approveUser(){


        $states = DB::table('states')->get();
        $cities = DB::table('cities')->get();
        $user_detail = User::where('role_id', 5)->orderBy('id', 'desc')->get();

        $user_detail_pending = User::where('role_id', 5)->orderBy('id', 'desc')->where('status',0)->where('is_library','1')->where('is_training','0')->where('is_course','0')->get();
        $user_detail_approve = User::where('role_id', 5)->where('status',1)->orderBy('registration_no', 'desc')->where('is_library','1')->where('is_training','0')->where('is_course','0')->get();
        $user_detail_reject = User::where('role_id', 5)->where('status',2)->orderBy('id', 'desc')->where('is_library','1')->where('is_training','0')->where('is_course','0')->get();

        return view("libadmin.approve_user", compact('user_detail_pending', 'states', 'cities','user_detail_approve','user_detail_reject','user_detail'));
    }

    public function checkMail(Request $request){
        // return $request;
         $mailExists = User::where('email', $request->useremail)->exists();
         $data['mailExists'] = $mailExists  ? 1 : 0;
        return response()->json($data);
    }
}
