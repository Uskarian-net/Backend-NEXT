<?php

namespace ATLauncher\Http\Middleware;

use Auth;
use Closure;

/**
 * This will require all requests (or just authenticated ones) to have a user agent sent in order to complete.
 *
 * If a user agent isn't provided then an error is returned and a 403 status code returned.
 *
 * @package ATLauncher\Http\Middleware
 */
class CheckUserAgent
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @param boolean $onlyAuthenticatedRoutes
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null, $onlyAuthenticatedRoutes = false)
    {
        if ((!$onlyAuthenticatedRoutes || (Auth::guard($guard)->check() && $onlyAuthenticatedRoutes)) && !$request->hasHeader('user-agent')) {
            return response()->json([
                'code' => 403,
                'error' => 'User agent must be specified for ' . ($onlyAuthenticatedRoutes ? 'authenticated' : 'all') . ' requests.'
            ], 403);
        }

        return $next($request);
    }
}
