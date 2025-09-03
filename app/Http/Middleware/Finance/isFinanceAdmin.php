<?php

namespace App\Http\Middleware\Finance;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;

class isFinanceAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // if(Auth::check()  && Auth::user()->role_id = 26){
        //     return $next($request);
        // }


        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasRole('Finance Admin')) {
                return $next($request);
            }
        }
        throw new AuthorizationException("Sorry, you don't have the permission!");
        // return redirect()->route('finance.login.show');
    }
}
