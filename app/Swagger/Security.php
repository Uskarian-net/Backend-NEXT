<?php

/**
 * @SWG\SecurityScheme(
 *   securityDefinition="oauth",
 *   type="oauth2",
 *   authorizationUrl="/oauth/authorize",
 *   tokenUrl="/oauth/token",
 *   flow="accessCode",
 *   scopes={
 *     "self:read": "read your account (except password)",
 *     "self:write": "write to account data"
 *   }
 * )
 */