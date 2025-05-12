<?php

namespace App\Http\Middleware\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth()->user()->type == 2 || Auth()->user()->type == 3 ){ // customer = 2 developer = 3 
            return $next($request);
        } else {
            return redirect()->route('login')->with('error', 'You do not have permission to access this page !');
        }
        return $next($request);
    }
}
