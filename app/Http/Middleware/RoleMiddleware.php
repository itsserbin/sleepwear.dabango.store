<?php

namespace App\Http\Middleware;

use App\Traits\HasRolesAndPermissions;
use Closure;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    use HasRolesAndPermissions, Authenticatable;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        if (!Auth::user()->hasRole($role)) {
            abort(404);
        }
        if ($permission !== null && !Auth::user()->can($permission)) {
            abort(404);
        }
        return $next($request);

    }
}

