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

    /**
     * Create a 'too many attempts' response.
     *
     * @param  string  $key
     * @param  int  $maxAttempts
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function buildResponse($key, $maxAttempts)
    {
        $response = response()->setStatusCode(429)->json([
            'error' => 'Rate limit reached. Please wait before making more requests.'
        ]);

        $retryAfter = $this->limiter->availableIn($key);

        return $this->addHeaders(
            $response, $maxAttempts,
            $this->calculateRemainingAttempts($key, $maxAttempts, $retryAfter),
            $retryAfter
        );
    }
}
