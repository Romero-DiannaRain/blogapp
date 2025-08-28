<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('student_id') && !$request->session()->has('faculty_id')) {
            return redirect()->route('student.login.form')
                ->with('error', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}


