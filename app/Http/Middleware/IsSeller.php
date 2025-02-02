<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('showLoginForm')->with('error', 'You must be logged in to access this page.');
        }

        if (Auth::user()->role !== 'seller') {
            abort(403, 'Anda tidak memiliki akses. Hanya Seller yang memiliki akses ini.');
        }

        return $next($request);
    }
}
