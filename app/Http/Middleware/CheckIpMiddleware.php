<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use App\Models\WhiteListedIp;

class CheckIpMiddleware
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
        $environment = env('APP_ENV');
        if ($environment == 'production' || $environment == 'live') {
            if (WhiteListedIp::where('address', $request->ip())->count() == 0) {

                return new JsonResponse([
                    'success' => false,
                    'message' => 'This IP address is not allowed to access the site.',
                ], 403);
            }
        }

        return $next($request);
    }
}
