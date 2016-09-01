<?php

namespace ATLauncher\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Routing\Middleware\ThrottleRequests;

class RateLimit extends ThrottleRequests
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param int $defaultMaxAttempts
     * @param float|int $decayMinutes
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $defaultMaxAttempts = 20, $decayMinutes = 1, $guard = null)
    {
        $maxAttempts = $defaultMaxAttempts;

        if (Auth::guard($guard)->check()) {
            /** @var \ATLauncher\Models\User $user */
            $user = Auth::guard($guard)->user();

            $maxAttempts = $user->rateLimit;
        }

        return parent::handle($request, $next, $maxAttempts, $decayMinutes);
    }
}
