<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if ($request->user() == null) {
            return redirect('/login');
        }
        if ($request->user()->role() == 0) {
            return redirect('/');
        }
        return $next($request);
    }
}
