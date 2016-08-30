<?php

namespace ATLauncher\Providers;

use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'ATLauncher\Model' => 'ATLauncher\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::pruneRevokedTokens();

        Passport::tokensCan([
            'self:read' => 'Read own user credentials (except password)',
            'self:write' => 'Change own user credentials (including password)',
        ]);
    }
}
