<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (Auth::check()) {
            // 1 là Admin, 0 là Users
            if (Auth::user()->role_as == '1') {
                return $next($request);
            } else {
                return redirect('/')->with('status', 'Permission denied, please try again.');
            }
        } else {
            return redirect('/login')->with('status', 'Please login first');
        }
    }
}
