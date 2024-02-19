<?php namespace Tipoff\GoogleApi\Drivers;

use Illuminate\Support\Facades\Auth;
use Tipoff\GoogleApi\Contracts\GoogleOauthDriver;
use Tipoff\GoogleApi\DataTransferObjects\AccessToken;
use Tipoff\GoogleApi\Models\Key;

class KeyEloquentDriver implements GoogleOauthDriver
{
    public function readAccessToken($identifier): AccessToken
    {
        $model = Key::where('slug', $identifier)->first();

        $accessToken = optional($model)->value;

        if (! $accessToken) {
            throw new \Exception('Cannot not read access token with identifier ' . $identifier);
        }

        return new AccessToken($accessToken);
    }

    public function flushAccessToken($identifier)
    {
        Key::where('slug', $identifier)->delete();
    }

    public function saveAccessToken($identifier, array $accessToken)
    {
        Key::updateOrCreate(
            ['slug' => $identifier],
            [
                'value' => $accessToken,
                'creator_id' => Auth::id(),
                'updater_id' => Auth::id(),
            ]
        );
    }
}
