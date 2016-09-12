<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class RootControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests the / route of the API for an unauthenticated user.
     *
     * @return void
     */
    public function testRootUnauthenticatedRoute()
    {
        $this->visit('/v1')
            ->seeJsonEquals([
                'authenticated' => false
            ]);
    }

    /**
     * Tests the / route of the API for a authenticated user that has scopes.
     *
     * @return void
     */
    public function testRootAuthenticatedRouteWithScopes()
    {
        /** @var \ATLauncher\Models\User $user */
        $user = factory(\ATLauncher\Models\User::class)->create();

        $this->actingAs($user, 'api')->withAccessToken(['self:read']);

        $this->visit('/v1')
            ->seeJsonEquals([
                'authenticated' => true,
                'scopes' => ['self:read'],
                'created_at' => $this->token->token->created_at,
                'expires_at' => $this->token->token->expires_at->toDateTimeString()
            ]);
    }

    /**
     * Tests the / route of the API for a authenticated user that hasn't got scopes.
     *
     * @return void
     */
    public function testRootAuthenticatedRouteWithoutScopes()
    {
        /** @var \ATLauncher\Models\User $user */
        $user = factory(\ATLauncher\Models\User::class)->create();

        $this->actingAs($user, 'api')->withAccessToken([]);

        $this->visit('/v1')
            ->seeJsonEquals([
                'authenticated' => true,
                'scopes' => [],
                'created_at' => $this->token->token->created_at,
                'expires_at' => $this->token->token->expires_at->toDateTimeString()
            ]);
    }
}
