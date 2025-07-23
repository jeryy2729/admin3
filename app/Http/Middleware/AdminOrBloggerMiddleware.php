<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOrBloggerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
         public function handle(Request $request, Closure $next)
    {
       
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        // Check web guard + blogger role
        if (Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole('blogger')) {
            return $next($request);
        }
        if (Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole('staff')) {
            return $next($request);
        }

        // Unauthorized
        abort(403, 'Unauthorized.');

    }



    }

