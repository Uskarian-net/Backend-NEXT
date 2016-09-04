<?php

namespace ATLauncher\Http\Middleware;

use Auth;
use Closure;

/**
 * This will require all requests to ensure that the authenticated user has the given role.
 *
 * If a user doesn't have the required role then a 403 error message will be returned.
 *
 * @package ATLauncher\Http\Middleware
 */
class CheckHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @param string $role
     * @return mixed
     * @internal param bool $onlyAuthenticatedRoutes
     */
    public function handle($request, Closure $next, $guard = null, $role)
    {
        if (!Auth::guard($guard)->check() | !Auth::guard($guard)->user()->hasRole($role)) {
            return response()->json([
                'code' => 403,
                'error' => 'You are not authorized to make that request.'
            ], 403);
        }

        return $next($request);
    }
}
