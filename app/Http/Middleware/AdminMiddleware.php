<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        if (Auth::check()) {
           
            if (Auth::user()->role === $roles) {
                return $next($request);
            }
            abort(403, 'Unauthorized access.');
        }
        abort(401, 'Unauthorized.');
    }
}
