<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Check user is `client` role
 *
 * @author goper
 */
class CheckUserIsClient
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
        if (!$request->user()->isClient) {
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
