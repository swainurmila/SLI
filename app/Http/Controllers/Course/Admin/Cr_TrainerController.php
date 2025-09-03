<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;

class Cr_TrainerController extends Controller
{
    public function index(){
        $states = DB::table('states')->get();
        $cities = DB::table('cities')->get();
        $user_detail_approve = User::where('role_id', 6)->where('status',1)->where('is_course','1')->orderBy('registration_no', 'desc')->get();
         

        return view("course.admin.users-management.trainer.index", compact('user_detail_approve','states','cities'));
    }
}
