<?php

/**
 * @SWG\Definition(@SWG\Xml(name="OauthTokenResponse"))
 */
class OauthTokenResponse
{
    /**
     * @var string
     * @SWG\Property(
     *     default="Bearer"
     * )
     */
    public $token_type;

    /**
     * @var integer
     * @SWG\Property()
     */
    public $expires_in;

    /**
     * @var string
     * @SWG\Property()
     */
    public $access_token;

    /**
     * @var string
     * @SWG\Property()
     */
    public $refresh_token;
}