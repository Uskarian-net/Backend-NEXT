<?php

/**
 * @SWG\GET(
 *     path="/oauth/scopes",
 *     summary="Get the scopes available.",
 *     description="Gets a listing of scopes available to get access from users.",
 *     tags={"oauth"},
 *     produces={"application/json"},
 *     @SWG\Response(
 *         response=200,
 *         description="successful operation",
 *         @SWG\Schema(
 *             type="array",
 *             @SWG\Items(ref="#/definitions/OauthScopesResponse")
 *         )
 *     )
 * )
 */

/**
 * @SWG\GET(
 *     path="/oauth/authorize",
 *     summary="Authorize user to your application.",
 *     description="Asks a user to login and authorize your application for the given scope and client. If the client is not already logged in with their ATLauncher account then they will
 *                  redirected to login first and then taken to a page displaying the scopes requested before being able to authorize or decline the request.",
 *     tags={"oauth"},
 *     produces={"application/json"},
 *     @SWG\Parameter(
 *         name="client_id",
 *         in="query",
 *         description="The client ID to authorize against.",
 *         required=true,
 *         type="string"
 *     ),
 *     @SWG\Parameter(
 *         name="redirect_uri",
 *         in="query",
 *         description="The url to redirect to once the authorization is allowed/denied.",
 *         required=true,
 *         type="string"
 *     ),
 *     @SWG\Parameter(
 *         name="response_type",
 *         in="query",
 *         description="The response type to receive.",
 *         required=true,
 *         type="string"
 *     ),
 *     @SWG\Parameter(
 *         name="scope",
 *         in="query",
 *         description="The scope to authorize against.",
 *         required=true,
 *         type="string"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="successful operation"
 *     )
 * )
 */

/**
 * @SWG\Post(
 *     path="/oauth/token",
 *     summary="Get access token from code.",
 *     description="Gets an access token from a code generated after a successful authorization.",
 *     tags={"oauth"},
 *     produces={"application/json"},
 *     @SWG\Parameter(
 *         name="parameters",
 *         in="body",
 *         description="Parameters needed to be sent in order to retrieve the token.",
 *         required=true,
 *         @SWG\Schema(ref="#/definitions/OauthTokenRequest")
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="successful operation",
 *         @SWG\Schema(ref="#/definitions/OauthTokenResponse")
 *     ),
 *     @SWG\Response(
 *         response="400",
 *         description="unsupported grant_type value"
 *     ),
 *     @SWG\Response(
 *         response="401",
 *         description="invalid client"
 *     )
 * )
 */