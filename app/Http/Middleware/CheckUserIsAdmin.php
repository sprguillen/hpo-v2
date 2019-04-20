<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserIsAdmin
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
        if (!$request->isAdmin()) {
            auth()->logout();
            session()->flush();

            return redirect()->route('home');
        }

        return $next($request);
    }
}
