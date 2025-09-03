<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;

class UserDashboardController extends Controller
{
    public function index(){
        return view('training.user-home');
    }

    public function logout(){
        Session::flush('success','Successfully Logged out !');
        Auth::logout();
        return redirect()->route('training.login.show');
    }
}
