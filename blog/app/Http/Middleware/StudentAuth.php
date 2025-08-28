<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StudentAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Check if student is logged in
        if (!$request->session()->has('user_id') || $request->session()->get('user_role') !== 'student') {
            return redirect('/')->with('error', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}
