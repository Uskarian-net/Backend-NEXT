<?php

namespace ATLauncher\Traits;

trait HasRoles
{
    /**
     * Checks if the user has the given role or not.
     *
     * @param string $roleToHave
     * @return bool
     */
    public function hasRole($roleToHave)
    {
        foreach ($this->roles as $role) {
            if ($role->name === $roleToHave) {
                return true;
            }
        }

        return false;
    }

    /**
     * Gets the maximum number of requests that can be done per 'period' defined in the 'ratelimit' middleware.
     *
     * @return int
     */
    public function getRateLimitAttribute()
    {
        $rateLimit = 20;

        foreach ($this->roles as $role) {
            if ($role->rate_limit > $rateLimit) {
                $rateLimit = $role->rate_limit;
            }
        }

        return $rateLimit;
    }
}
