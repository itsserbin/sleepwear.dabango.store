<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecuredHttp
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if (!$request->secure() && env('APP_ENV') !== 'local') {
            return redirect()->secure($request->path());
        }
        return $next($request);
    }
}
