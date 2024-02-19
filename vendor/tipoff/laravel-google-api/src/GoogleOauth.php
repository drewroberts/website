<?php namespace Tipoff\GoogleApi;

use Google_Client;
use Illuminate\Support\Facades\Route;
use Tipoff\GoogleApi\Contracts\GoogleOauthDriver;
use Tipoff\GoogleApi\DataTransferObjects\AccessToken;

class GoogleOauth
{
    protected Google_Client $googleClient;

    protected string $identifier = '';

    public function __construct(Google_Client $googleClient, array $config)
    {
        $this->googleClient = $googleClient;
        $this->googleClient->setClientId($config['client_id']);
        $this->googleClient->setClientSecret($config['client_secret']);
        $this->googleClient->setRedirectUri($config['redirect_uri']);
        $this->googleClient->setState($config['state']);
        $this->googleClient->setAccessType('offline');
        $this->googleClient->setApprovalPrompt('force');
    }

    /**
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * @param array $scopes
     * @return $this
     */
    public function setScopes(array $scopes): self
    {
        $this->googleClient->setScopes($scopes);

        return $this;
    }

    /**
     * Get access token.
     *
     * @param string|null $identifier
     * @return AccessToken
     */
    public function accessToken(?string $identifier = null): AccessToken
    {
        // Set identifier on the fly.
        if (! is_null($identifier)) {
            $this->setIdentifier($identifier);
        }

        $accessToken = $this->readAccessToken();

        // Refresh access token if it has expired.
        if ($accessToken->hasExpired()) {
            $accessToken = $this->refreshAccessToken($accessToken->getRefreshToken());
        }

        return $accessToken;
    }

    /**
     * @return AccessToken
     * @throws \Exception
     */
    public function makeAccessToken(): AccessToken
    {
        $authCode = request()->get('code');

        if (empty($authCode)) {
            throw new \Exception('Cannot get the auth code from Google');
        }

        $accessToken = $this->googleClient->fetchAccessTokenWithAuthCode($authCode);

        // Set identifier before calling saveAccessToken
        $this->setIdentifier(session('google_oauth_identifier'));

        request()->session()->forget('google_oauth_identifier');

        $this->saveAccessToken($accessToken);

        return new AccessToken($accessToken);
    }

    /**
     * @param string|null $refreshToken
     * @return AccessToken
     */
    public function refreshAccessToken(?string $refreshToken = null): AccessToken
    {
        if (is_null($refreshToken)) {
            $refreshToken = $this->accessToken()->getRefreshToken();
        }

        $this->googleClient->fetchAccessTokenWithRefreshToken($refreshToken);

        $token = $this->googleClient->getAccessToken();

        $this->saveAccessToken($token);

        return new AccessToken($token);
    }

    /**
     * @return AccessToken
     */
    public function readAccessToken(): AccessToken
    {
        return $this->getGoogleOauthDriver()->readAccessToken($this->identifier);
    }

    /**
     * @return void
     */
    public function flushAccessToken()
    {
        $this->getGoogleOauthDriver()->flushAccessToken($this->identifier);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect(?string $identifier = null, ?string $homeUrl = '/')
    {
        // These data can be pulled in callback method.
        session(['google_oauth_identifier' => $identifier ?? '']);
        session(['google_oauth_home_url' => $homeUrl]);

        return redirect()->to($this->getAuthUrl());
    }

    /**
     * Gets the URL to authorize the user
     *
     * @return string
     */
    public function getAuthUrl(): string
    {
        return $this->googleClient->createAuthUrl();
    }

    /**
     * Alias of "googleOauth" route marco.
     *
     * @return mixed
     */
    public function routes()
    {
        return Route::googleOauth();
    }

    /**
     * Register a Google Oauth driver class.
     *
     * @param string $class
     * @return void
     */
    public function useDriver(string $class)
    {
        app()->singleton(GoogleOauthDriver::class, $class);
    }

    protected function saveAccessToken(array $accessToken)
    {
        $this->getGoogleOauthDriver()->saveAccessToken($this->identifier, $accessToken);
    }

    protected function getGoogleOauthDriver(): GoogleOauthDriver
    {
        return app(GoogleOauthDriver::class);
    }
}
