<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('iddata') == null)
            return redirect()->route('user.login');
        return $next($request);
    }
}
