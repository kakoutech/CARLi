<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccountType
{
    public function handle(Request $request, Closure $next, $role)
    {
        $role = explode('|', $role);

        if (Auth::check() && in_array(Auth::user()->account_type, $role)) {
            Auth::user()->recordSession();
            return $next($request);
        } else {
            if (Auth::check()) {
                if (Auth::user()->account_type == 'admin') {
                    return redirect()->route('dashboard');
                } elseif (Auth::user()->account_type == 'learner') {
                    return redirect()->route('dashboard');
                } elseif (Auth::user()->account_type == 'trainer') {
                    return redirect()->route('dashboard');
                } elseif (Auth::user()->account_type == 'employer') {
                    return redirect()->route('dashboard');
                }
            }

            auth()->guard('web')->logout();
            return redirect()->route('login');
        }
    }
}
