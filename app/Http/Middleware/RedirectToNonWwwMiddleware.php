<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectToNonWwwMiddleware
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
        if (str_starts_with($request->header('host'), 'www.')) {
            $request->headers->set('host', env('SESSION_DOMAIN'));
            return redirect()->secure($request->path());;
        }
        return $next($request);
    }
}
