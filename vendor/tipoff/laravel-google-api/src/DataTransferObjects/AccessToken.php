<?php namespace Tipoff\GoogleApi\DataTransferObjects;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class AccessToken extends FlexibleDataTransferObject
{
    public string $access_token;

    public int $expires_in;

    public string $scope;

    public string $token_type;

    public int $created;

    public string $refresh_token;

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    /**
     * @return int
     */
    public function getExpires()
    {
        return $this->expires_in;
    }

    /**
     * @return bool
     */
    public function hasExpired()
    {
        return $this->getExpires() < time();
    }
}
