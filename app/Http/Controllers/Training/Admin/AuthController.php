<?php

namespace App\Http\Controllers\Training\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Session;

class AuthController extends Controller
{
    public function loginShow(){
        return view('training.admin.auth.login');
    }

    public function loginCheck(Request $request){

        $request->validate([
            'email'=>'required',
            'password'=>'required',
            'captcha' => ['required', 'captcha'],
        ]);

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->where('role_id','3')->first();
        
        if ($user && $user->status == 1) {
           
            // Attempt to log in the training
            if (Auth::attempt($credentials,$request->filled('remember'))) {
                return redirect()->intended('training/dashboard')
                            ->withSuccess('You have Successfully loggedin');
            }
        }
        Session::flash('error','Oppes ! You have entered invalid credentials');
        return redirect()->back();
    }

    public function adminLogout(){
        Session::flush('success','Successfully Logged out !');
        Auth::logout();
        return redirect()->route('training.login.show');
    }
}
