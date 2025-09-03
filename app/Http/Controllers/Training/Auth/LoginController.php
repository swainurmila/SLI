<?php

namespace App\Http\Controllers\Training\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Auth;


class LoginController extends Controller
{
    public function showLogin(Request $request){

        return view('training.auth.login');
    }

    public function attemptLogin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
            'captcha' => ['required', 'captcha'],
        ]);
        // return $request;
        // return  session()->token();
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();


        if($user){

            if($user->status == '0'){
                Session::flash('error','Your account is not activated yet please try again later !');
                return redirect()->back();
            }

            if($user->status == '2'){
                Session::flash('error','Your account is rejected');
                return redirect()->back();
            }

            if($user){

                // dd($user);

                    if( $user->status == 1 && $user->role_id == 3){


                        if (Auth::attempt($credentials,$request->filled('remember'))) {
                            return redirect()->intended('portal/training/dashboard')
                                        ->withSuccess('You have Successfully Logged in');
                        }else{
                            Session::flash('error','Oppes ! You have entered invalid credentials');
                            return redirect()->back();
                        }
                    }

                    if($user->is_delete == '2'){


                        if( $user->status == 1 && $user->role_id == 6){
                            if (Auth::attempt($credentials,$request->filled('remember'))) {
                                return redirect()->intended('portal/training/dashboard')
                                            ->withSuccess('You have Successfully Logged in');
                            }else{
                                Session::flash('error','Oppes ! You have entered invalid credentials');
                                return redirect()->back();
                            }
                        }

                        if( $user->status == 1 && $user->is_training_role == 1){
                            // dd("dd");
                            if (Auth::attempt($credentials,$request->filled('remember'))) {
                                return redirect()->intended('portal/training/dashboard')
                                            ->withSuccess('You have Successfully Logged in');
                            }else{
                                Session::flash('error','Oppes ! You have entered invalid credentials');
                                return redirect()->back();
                            }
                        }



                        if ($user->status == 1 && $user->role_id == 5) {
                            // Attempt to log in the training

                            if (Auth::attempt($credentials,$request->filled('remember'))) {
                                return redirect()->intended('portal/training/profile')
                                            ->withSuccess('You have Successfully Logged in');
                            }else{
                                Session::flash('error','Oppes ! You have entered invalid credentials');
                                return redirect()->back();
                            }
                        }
                    }else{
                        Session::flash('error','Your account is inactive please contact admin !');
                        return redirect()->back();
                    }
            }
        }else{
            Session::flash('error','Oppes ! You have entered invalid credentials');
            return redirect()->back();
        }


    }
}
