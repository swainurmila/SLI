<?php

namespace App\Http\Middleware\Course;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Session;

class isCourseAdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()  && Auth::user()->role_id == 5 && Auth::user()->is_course == 1){
            return $next($request);
        }
        Session::flush();
        Session::flash('error',"Sorry you don't have the permission !");
        return redirect()->route('course.login.show');
    }
}
