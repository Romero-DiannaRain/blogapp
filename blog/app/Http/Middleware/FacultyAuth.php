<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FacultyAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('faculty_id')) {
            return redirect()->route('faculty.login.form')
                ->with('error', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}


