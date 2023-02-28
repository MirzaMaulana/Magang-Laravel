<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class status
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
        if (Auth::user()->status != 'Active') {
            Auth::logout();
            return redirect("/login")->with('error', 'Akun Anda Telah Terblokir');
        } elseif (Auth::user()->role != 'Member') {
            return $next($request);
        } elseif (!auth()->user()->email_verified_at) {
            return redirect('/email/verify');
        } else {
            return redirect('/');
        }
    }
}
