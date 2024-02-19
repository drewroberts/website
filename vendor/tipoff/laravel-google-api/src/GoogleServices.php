<?php namespace Tipoff\GoogleApi;

use Google_Client;
use Google_Service_Analytics;
use Google_Service_MyBusiness;
use Google_Service_YouTube;
use Google_Service_YouTubeAnalytics;
use Illuminate\Support\Collection;
use SchulzeFelix\SearchConsole\SearchConsole;
use SchulzeFelix\SearchConsole\SearchConsoleClient;
use SKAgarwal\GoogleApi\PlacesApi;
use Tipoff\GoogleApi\DataTransferObjects\AccessToken;

class GoogleServices
{
    private Google_Client $googleClient;

    public function __construct(Google_Client $googleClient)
    {
        $this->googleClient = $googleClient;
    }

    /**
     * Set access token before access the services.
     *
     * @param $accessToken
     * @return $this
     */
    public function setAccessToken($accessToken): self
    {
        if ($accessToken instanceof AccessToken) {
            $accessToken = $accessToken->getAccessToken();
        }

        $this->googleClient->setAccessToken($accessToken);

        return $this;
    }

    /**
     * Get enabled services in google-api config file.
     *
     * @return Collection
     */
    public function availableServices(): Collection
    {
        $allServices = collect(config('google-api.services'));

        return $allServices->where('status', GoogleServiceStatus::ENABLED);
    }

    /**
     * Get all needed scopes from enabled services.
     *
     * @return array
     */
    public function scopes(): array
    {
        return $this->availableServices()->pluck('scopes')
            ->filter()
            ->flatten()
            ->all();
    }

    public function searchConsole(): SearchConsole
    {
        $this->ensureServiceEnabled('search-console');

        return (new SearchConsole(app(SearchConsoleClient::class)))
            ->setAccessToken($this->googleClient->getAccessToken());
    }

    public function myBusiness(): Google_Service_MyBusiness
    {
        $this->ensureServiceEnabled('my-business');

        return new Google_Service_MyBusiness($this->googleClient);
    }

    public function youtube(): Google_Service_YouTube
    {
        $this->ensureServiceEnabled('youtube');

        return new Google_Service_YouTube($this->googleClient);
    }

    public function youtubeAnalytics(): Google_Service_YouTubeAnalytics
    {
        $this->ensureServiceEnabled('youtube-analytics');

        return new Google_Service_YouTubeAnalytics($this->googleClient);
    }

    public function analytics(): Google_Service_Analytics
    {
        $this->ensureServiceEnabled('analytics');

        return new Google_Service_Analytics($this->googleClient);
    }

    public function places(): PlacesApi
    {
        $this->ensureServiceEnabled('places');

        /**
         * @psalm-suppress InvalidArgument
         */
        return new PlacesApi(
            config('google-api.services.places.key'),
            config('google-api.services.places.verify_ssl'),
            config('google-api.services.places.headers')
        );
    }

    protected function ensureServiceEnabled(string $serviceKey)
    {
        $serviceStatus = config("google-api.services.$serviceKey.status", GoogleServiceStatus::DISABLED);

        if ($serviceStatus === GoogleServiceStatus::DISABLED) {
            throw new \Exception("Service $serviceKey is not enabled.");
        }
    }
}
