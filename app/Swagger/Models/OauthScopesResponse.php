<?php

/**
 * @SWG\Definition(@SWG\Xml(name="OauthScopesResponse"))
 */
class OauthScopesResponse
{
    /**
     * The name of the scope.
     *
     * @var string
     * @SWG\Property()
     */
    public $id;

    /**
     * The description for the scope.
     * 
     * @var string
     * @SWG\Property()
     */
    public $description;
}