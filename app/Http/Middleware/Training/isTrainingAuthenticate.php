<?php

namespace App\Http\Middleware\Training;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Session;

class isTrainingAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && Auth::user()->hasRole('User') && Auth::user()->is_training == 1){
            return $next($request);
        }
        Session::flush();
        Session::flash('error',"Sorry you don't have the permission !");
        return redirect()->route('training.login.show');
    }
}
