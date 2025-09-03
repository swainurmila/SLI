<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Website\WebsiteVisitor;
use Session;
class CountVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!Session::has('visitor_counted')) {
            // Count the visitor
            WebsiteVisitor::incrementVisitorCount();
            // Mark the visitor as counted
            Session::put('visitor_counted', true);
        }

        return $next($request);
    }
}
