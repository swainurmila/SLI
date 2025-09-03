<?php

namespace App\Http\Controllers\Finance\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;

class AuthController extends Controller
{
    public function showLogin(){

        return view('finance.auth.login');
    }

    public function attemptLogin(Request $request){

        $request->validate([
            'email'=>'required',
            'password'=>'required',
            'captcha' => ['required', 'captcha'],
        ]);

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();


        if($user){
            if ($user->status == '0') {
                if ($user->status == 0 && $user->is_finance == 1) {

                    if (Auth::attempt($credentials, $request->filled('remember'))) {
                        return redirect()->route('finance.dashboard.show')
                            ->withSuccess('You have Successfully Logged in');
                    } else {
                        Session::flash('error', 'Oppes ! You have entered invalid credentials');
                        return redirect()->back();
                    }
                }else{
                    Session::flash('error', 'Your account is not activated yet please try again later !');
                    return redirect()->back();
                }
            }

            if ($user->status == '2') {
                Session::flash('error', 'Your account is rejected');
                return redirect()->back();
            }
            if ($user && Hash::check($request->password, $user->password)) {

                // $user->role_id = 27;
                //     $user->role = 'Finance User';
                //     $user->assignRole('Finance User');
                //     $user->save();

                if ($user->status == 1 && $user->is_finance == 1) {

                    if (Auth::attempt($credentials, $request->filled('remember'))) {
                        return redirect()->route('finance.dashboard.show')
                            ->withSuccess('You have Successfully Logged in');
                    } else {
                        Session::flash('error', 'Oppes ! You have entered invalid credentials');
                        return redirect()->back();
                    }
                }else {

                    Session::flash('error', 'Oppes ! You have entered invalid credentials');
                    return redirect()->back();
                }
            } else {
                Session::flash('error', 'Account not created yet or invalid credentials');
                return redirect()->back();
            }
            // if($user->status == '0'){
            //     Session::flash('error','Your account is not activated yet please try again later !');
            //     return redirect()->back();
            // }else if($user->status == '2'){
            //     Session::flash('error','Your account is rejected');
            //     return redirect()->back();
            // }else{

            //     if (Auth::attempt($credentials,$request->filled('remember'))) {
            //         return redirect()->route('finance.dashboard.show')->withSuccess('You have Successfully loggedin');
            //     }else{
            //         Session::flash('error','Oppes ! You have entered invalid credentials');
            //         return redirect()->back();
            //     }

            // }
        }else {
            Session::flash('error', 'Oppes ! You have entered invalid credentials');
            return redirect()->back();
        }


        Session::flash('error','Account not found !');
        return redirect()->back();
    }


    public function financeLogout(){
        Session::flush('success','Successfully Logged out !');
        Auth::logout();
        return redirect()->route('finance.login.show');
    }
}
