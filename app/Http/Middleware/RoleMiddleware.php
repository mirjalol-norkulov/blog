<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, string $role)
    {
        if (!$request->user() || !$request->user()->hasRole($role)) {
            throw new AccessDeniedException('Sizda ruxsat mavjud emas');
        }
        return $next($request);
    }
}
