<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CacheControl
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->header('Cache-Control', 'private, max-age=0, no-cache');
        $response->header('Expires', Carbon::now()->addDay()->format('r'));
        $response->header('Last-Modified', Carbon::today()->format('r'));
        return $response;
    }
}
