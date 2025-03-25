<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, string $role)
    {

        if (!Auth::check()) {
            return redirect('/login');
        }


        if (Auth::user()->role !== $role) {
            return redirect()->route('dashboard');
        }


        return $next($request);
    }
}

