<?php

/**
 * @SWG\Swagger(
 *     basePath="/",
 *     consumes={"application/json"},
 *     produces={"application/json"},
 *     @SWG\Info(
 *         version=API_VERSION,
 *         title="ATLauncher API",
 *         description="This is the API for accessing data for ATLauncher. Please note that any authenticated requests will list the scopes needed to access and will need an 'Authorization: Bearer
                        {token}' heading. This token can be created by following the OAuth section below. Alternatively to test the API in Swagger with authorizaton needed, enter your client id
                        and secret in the top box (optionally clicking save to remember those credentials on page refresh) so that you can use the on/off toggles beside calls needing authentication
                        using your client id and client secretFor now there is no way to create new OAuth clients for use in your own applications, but this will be coming in the future."
 *     )
 * )
 */