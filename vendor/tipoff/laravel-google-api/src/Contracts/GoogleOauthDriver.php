<?php namespace Tipoff\GoogleApi\Contracts;

use Tipoff\GoogleApi\DataTransferObjects\AccessToken;

interface GoogleOauthDriver
{
    public function readAccessToken($identifier): AccessToken;

    public function flushAccessToken($identifier);

    public function saveAccessToken($identifier, array $accessToken);
}
