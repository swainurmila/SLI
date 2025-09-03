<?php

namespace App\Http\Middleware\Training;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class RedirectAdminIfTrainingUnauthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role_id == '3'){
            return redirect()->route('admin.training.dashboard');
        }
        return $next($request);
    }
}
