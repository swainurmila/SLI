<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     * 
     */
    protected $redirectTo = '/';
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function reset(Request $request)
    {
        // Validate the request...

        // Attempt to reset the password...
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            // Set a flag in session storage
            echo "<script>sessionStorage.setItem('passwordReset', 'true');</script>";
            return redirect()->url('/')->with('status', __($response));
        }

        return back()->withErrors(['email' => [__($response)]]);
    }
}
