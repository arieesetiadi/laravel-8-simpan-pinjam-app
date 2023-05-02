<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateAny
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $guards = ['pegawai', 'pengawas', 'tim_verifikasi'];

        foreach ($guards as $guard) {
            $isAuthenticated = auth()->guard($guard)->check();

            if ($isAuthenticated) {
                $user = auth()->guard($guard)->user();
                return $next($request)->withInput($user);
            }
        }

        return redirect()->route('tampilLogin');
    }
}