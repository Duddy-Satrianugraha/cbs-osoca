<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Power
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('power')) {
            $userId = session('power');

            // Pastikan user belum dalam sesi impersonasi agar tidak login berkali-kali
            if (!Auth::check() || Auth::id() !== $userId) {
                Auth::loginUsingId($userId);
            }
        }
        return $next($request);
    }
}
