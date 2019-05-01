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
        if ($request->user()->isNotAdmin) {
            if ($request->expectsJson()) {
                
                $request->user()->token()->revoke();
            } else {
                auth()->logout();
                session()->flush();
            }


            return redirect()->route('home', ['any' => '']);
        }

        return $next($request);
    }
}
