<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $roles = is_array($role)
            ? $role
            : explode('|', $role);

        if (!$request->user() || !$request->user()->hasAnyRole($roles)) {
            throw new AccessDeniedException('Sizda ruxsat mavjud emas');
        }
        return $next($request);
    }
}
