<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;

class Cr_UserController extends Controller
{
    public function index(){

        $states = DB::table('states')->get();
        $cities = DB::table('cities')->get();

        $user_detail_pending = User::where('role_id', 5)->orderBy('id', 'desc')->where('status',0)->where('is_course','1')->get();
        $user_detail_approve = User::where('role_id', 5)->where('status',1)->orderBy('id', 'desc')->where('is_course','1')->get();
        $user_detail_reject = User::where('role_id', 5)->where('status',2)->orderBy('id', 'desc')->where('is_course','1')->get();
        
        return view('course.admin.users-management.users.index',compact('user_detail_pending', 'states', 'cities','user_detail_approve','user_detail_reject'));
    }

    public function edit(){

    }

    public function update(){

    }

    public function updateStatus(){

    }
}
