<?php

namespace ATLauncher\Testing\Concerns;

use Laravel\Passport\Token;

trait CreatesAccessTokens
{
    /**
     * @var \Laravel\Passport\PersonalAccessTokenResult
     */
    private $token;

    /**
     * Give the current user a token with the defined scopes.
     *
     * @param string[] $scopes
     * @param string $guard
     * @return $this
     */
    public function withAccessToken(array $scopes, $guard = 'api')
    {
        /** @var \ATLauncher\Models\User $user */
        $user = $this->app['auth']->guard($guard)->user();

        $this->token = $user->createToken('Test Token', $scopes);

        $this->serverVariables = [
            'HTTP_Authorization' => 'Bearer ' . $this->token->accessToken
        ];

        $user->withAccessToken($this->token->token);

        return $this;
    }
}