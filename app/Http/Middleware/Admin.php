<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        switch (Auth::user()->role) {
            case 'admin':
                return $next($request);
                
            case 'karyawan':
                return redirect()->route('karyawan.dashboard');
        }
    }
}
