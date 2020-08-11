<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Karyawan
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
                return redirect()->route('admin.dashboard');
                
            case 'karyawan':
                return $next($request);
        }
    }
}
