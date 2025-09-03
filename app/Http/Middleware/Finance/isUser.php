<?php

namespace App\Http\Middleware\Finance;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()  && Auth::user()->is_finance == 1){
            return $next($request);
        }
        return redirect()->route('finance.login.show');
    }
}
