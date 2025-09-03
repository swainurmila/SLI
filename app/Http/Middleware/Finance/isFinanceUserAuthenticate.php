<?php

namespace App\Http\Middleware\Finance;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Session;
use Illuminate\Auth\Access\AuthorizationException;

class isFinanceUserAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // if(Auth::check()  && Auth::user()->role_id == 27 && Auth::user()->is_finance == 1){
        //     return $next($request);
        // }


        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasRole('Finance User') && $user->is_finance == 1) {
                return $next($request);
            }
        }

        throw new AuthorizationException("Sorry, you don't have the permission!");
        // Session::flush();
        // Session::flash('error',"Sorry you don't have the permission !");
        // return redirect()->route('finance.login.show');
    }
}
