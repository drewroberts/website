<?php namespace Tipoff\GoogleApi\Drivers;

use Spatie\Valuestore\Valuestore;
use Tipoff\GoogleApi\Contracts\GoogleOauthDriver;
use Tipoff\GoogleApi\DataTransferObjects\AccessToken;

class JsonDriver implements GoogleOauthDriver
{
    protected ?Valuestore $valuestore = null;

    public function readAccessToken($identifier): AccessToken
    {
        $accessToken = $this->valueStore($identifier)->all();

        if (! count($accessToken)) {
            throw new \Exception('Cannot not read access token with identifier ' . $identifier);
        }

        return new AccessToken($accessToken);
    }

    public function flushAccessToken($identifier)
    {
        $this->valueStore($identifier)->flush();
    }

    public function saveAccessToken($identifier, array $accessToken)
    {
        $this->valueStore($identifier)->flush();

        $this->valueStore($identifier)->put($accessToken);
    }

    private function valueStore($identifier)
    {
        if (is_null($this->valuestore)) {
            $this->valuestore = Valuestore::make(storage_path('app/google-oauth/' . $identifier . '.json'));
        }

        return $this->valuestore;
    }
}
