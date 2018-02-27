<?php

namespace ZestSoftware\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class OdooResourceOwner implements ResourceOwnerInterface
{
    /**
     * Raw response
     *
     * @var
     */
    protected $response;

    /**
     * Creates new resource owner.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }

    /**
     * Get resource owner id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->response['sub'] ?: null;
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }

    /**
     * Get emailaddress
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->response['email'] ?: null;
    }

    /**
     * Get email verified
     *
     * @return bool
     */
    public function isEmailVerified()
    {
        return (bool) $this->response['email_verified'] ?: false;
    }

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->response['name'] ?: null;
    }

    /**
     * Get name
     *
     * @return string|null
     */
    public function getPreferredName()
    {
        return $this->response['preferred_username'] ?: null;
    }

    /**
     * Get name
     *
     * @return string|null
     */
    public function getZoneInfo()
    {
        return $this->response['zoneinfo'] ?: null;
    }
}
