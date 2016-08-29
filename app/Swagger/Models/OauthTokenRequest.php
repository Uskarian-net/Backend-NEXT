<?php

/**
 * @SWG\Definition(@SWG\Xml(name="OauthTokenRequest"))
 */
class OauthTokenRequest
{
    /**
     * @var string
     * @SWG\Property(
     *     default="authorization_code"
     * )
     */
    public $grant_type;

    /**
     * @var string
     * @SWG\Property()
     */
    public $client_id;

    /**
     * @var string
     * @SWG\Property()
     */
    public $client_secret;

    /**
     * @var string
     * @SWG\Property()
     */
    public $redirect_uri;

    /**
     * @var string
     * @SWG\Property()
     */
    public $code;
}