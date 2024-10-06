<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirebaseAuth
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('login') || $request->is('register')) {
            return $next($request);
        }

        if (!Auth::check()) {
            return redirect('/login');
        }

        return $next($request);
    }
}
