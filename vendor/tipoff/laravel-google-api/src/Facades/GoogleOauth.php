<?php namespace Tipoff\GoogleApi\Facades;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Facade;
use Tipoff\GoogleApi\DataTransferObjects\AccessToken;

/**
 * @see \Tipoff\GoogleApi\GoogleAuth
 *
 * @method static \Tipoff\GoogleApi\GoogleOauth setIdentifier(string $identifier)
 * @method static \Tipoff\GoogleApi\GoogleOauth setScopes(array $scopes)
 * @method static AccessToken accessToken(?string $identifier = null)
 * @method static AccessToken makeAccessToken()
 * @method static AccessToken refreshAccessToken(?string $refreshToken = null)
 * @method static AccessToken readAccessToken()
 * @method static void flushAccessToken()
 * @method static RedirectResponse redirect(?string $identifier = null, ?string $homeUrl = '/')
 * @method static string getAuthUrl()
 * @method static mixed routes()
 * @method static void useDriver(string $class)
 */
class GoogleOauth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'google-oauth';
    }
}
