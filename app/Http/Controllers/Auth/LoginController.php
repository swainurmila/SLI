<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Mews\Captcha\Facades\Captcha;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            // 'captcha' => ['required', 'captcha']
        ]);

        $user = User::where('email', $request->email)->first();
        $credentials = $request->only('email', 'password');

        if($user){

            if($user->role_id == 1 && $user->status == 1){
    
                if (Auth::attempt($credentials)) {
    
                    $session['name'] = $user->name;
                    $session['email'] = $user->email;
                    $session['id'] = $user->id;
                    $request->session()->put('userdata', $session);
                    return redirect()->intended('/portal/admin/home');
                }
                return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
            }else{
                if (Auth::attempt($credentials)) {
                    $session['name'] = $user->name;
                    $session['email'] = $user->email;
                    $session['id'] = $user->id;
                    $request->session()->put('userdata', $session);
                    return redirect()->intended('/dashboard');
                }
    
                return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
            }
        }else{
            return redirect()->back()->withErrors(['email' => 'No Record found !']);
        }
    }
}
