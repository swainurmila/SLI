<?php

namespace App\Http\Controllers\Eoffice\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\e_office\officeUser;
use Session;
use Auth;
class LoginController extends Controller
{
    public function showLogin(){
        return view('Eoffice.auth.login');
    }

    public function attemptLogin(Request $request){


        $request->validate([
            'login_for'=>'required',
            'email'=>'required',
            'password'=>'required',
            'captcha' => ['required', 'captcha'],
        ]);

        $credentials = $request->only('email', 'password');

        $user = officeUser::where('email', $request->email)->where('login_for',$request->login_for)->first();

        if($user){

            if($user->status == '0'){
                Session::flash('error','Your account is not activated yet please try again later !');
                return redirect()->back();
            }

            if($user->status == '2'){
                Session::flash('error','Your account is rejected');
                return redirect()->back();
            }



            if( $user->status == 1){
                // dd(Auth::guard('officer')->attempt($credentials, $request->filled('remember')));
                if (Auth::guard('officer')->attempt($credentials, $request->filled('remember'))) {
                    return redirect()->route('admin.office.dashboard')->withSuccess('You have Successfully Logged in');
                }

            }
        }else{

            Session::flash('error','Oppes ! You have entered invalid credentials');
            return redirect()->back();
        }



    }


    public function officeLogout(){
        Session::flush('success','Successfully Logged out !');
        Auth::logout();
        return redirect()->route('office.login.show');
    }
}
