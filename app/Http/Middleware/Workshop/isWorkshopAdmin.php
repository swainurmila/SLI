<?php

namespace App\Http\Middleware\Workshop;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class isWorkshopAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()  && Auth::user()->role_id = 10){
            return $next($request);
        }
        return redirect()->route('workshop.login.show');
    }
}
