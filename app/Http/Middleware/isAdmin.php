<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        dd(Auth::user());
		if (Auth::user() && Auth::user()->role && Auth::user()->role->name !== 'admin') {
            abort(404);  // Redirect to 404 page if not an admin
        }
		
	    return $next($request);
			
    }
}
