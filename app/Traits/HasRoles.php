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
}
