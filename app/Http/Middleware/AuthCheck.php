<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedRoutes = ['login-menu', 'login', 'register-menu', 'register'];

        if (!session()->has('user') && !in_array($request->route()->getName(), $allowedRoutes)) {
            return redirect()->route('login-menu');
        }

        return $next($request);
    }

}
