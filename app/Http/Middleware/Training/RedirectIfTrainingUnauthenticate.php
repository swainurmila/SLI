<?php

namespace App\Http\Middleware\Training;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Session;

class RedirectIfTrainingUnauthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){

            Session::flush();
            // if(Auth::user()->role_id == 3){
            //     return redirect()->route('training.dashboard');
            // }
            // if(Auth::user()->role_id == 5){
            //     return redirect()->route('admin.training.dashboard');
                
            // }
        }
        return $next($request);
    }
}
