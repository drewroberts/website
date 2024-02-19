<?php

namespace SchulzeFelix\SearchConsole;

use Google_Service_Webmasters_ApiDimensionFilter;
use Google_Service_Webmasters_ApiDimensionFilterGroup;
use Google_Service_Webmasters_SearchAnalyticsQueryRequest;
use Illuminate\Support\Collection;

class SearchConsole
{
    /** @var SearchConsoleClient */
    protected $client;

    /**
     * @param SearchConsoleClient $client
     */
    public function __construct(SearchConsoleClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $quotaUser
     *
     * @return $this
     */
    public function setQuotaUser(string $quotaUser)
    {
        $this->client->setQuotaUser($quotaUser);

        return $this;
    }

    /**
     * @param string|array $accessToken
     *
     * @return $this
     */
    public function setAccessToken($accessToken)
    {
        if (is_array($accessToken)) {
            $accessToken = trim(json_encode($accessToken));
        }

        $this->client->setAccessToken($accessToken);

        $this->client->getGoogleClient()->getCache()->clear();

        return $this;
    }

    /**
     * @param string $siteUrl
     * @return array
     */
    public function getSite(string $siteUrl)
    {
        $sites = $this->client->getWebmastersService()->sites;

        $siteInfo = $sites->get($siteUrl);

        $response = [
            'siteUrl' => $siteInfo->getSiteUrl(),
            'permissionLevel' => $siteInfo->getPermissionLevel(),
        ];

        return $response;
    }

    public function listSites()
    {
        $sites = $this->client->getWebmastersService()->sites;
        $siteList = $sites->listSites();

        $sitesCollection = new Collection();
        foreach ($siteList->getSiteEntry() as $site) {
            $sitesCollection->push([
                'siteUrl' => $site->siteUrl,
                'permissionLevel' => $site->permissionLevel,
            ]);
        }
        $sitesCollection = $sitesCollection->sortBy('siteUrl');

        return $sitesCollection;
    }

    /**
     * Call the query method on the authenticated client.
     *
     * @param string $siteUrl
     * @param Period $period
     * @param array $dimensions
     * @param array $filters
     * @param int $rows
     * @param string $searchType
     * @param string $dataState
     * @param string $aggregationType
     * @return Collection
     * @throws \Exception
     */
    public function searchAnalyticsQuery(string $siteUrl, Period $period, array $dimensions = [], array $filters = [], int $rows = 1000, string $searchType = 'web', string $dataState = 'final', string $aggregationType = 'auto')
    {
        $request = new Google_Service_Webmasters_SearchAnalyticsQueryRequest();
        $request->setStartDate($period->startDate->toDateString());
        $request->setEndDate($period->endDate->toDateString());
        $request->setSearchType($searchType);
        $request->setDimensions($dimensions);
        $request->setDataState($dataState);
        $request->setAggregationType($aggregationType);
        $request = $this->applyFilters($request, $filters);

        return $this->client->performQuery($siteUrl, $rows, $request);
    }

    public function isAccessTokenExpired()
    {
        $googleClient = $this->client->getGoogleClient();

        $newToken = $googleClient->fetchAccessTokenWithRefreshToken();

        if (isset($newToken['error'])) {
            return true;
        }

        $googleClient->setAccessToken($newToken);

        return $googleClient->isAccessTokenExpired();
    }

    /*
     * Get the underlying Google_Service_Webmasters object. You can use this
     * to basically call anything on the Google Search Console API.
     */
    public function getWebmastersService(): \Google_Service_Webmasters
    {
        return $this->client->getWebmastersService();
    }

    private function applyFilters(Google_Service_Webmasters_SearchAnalyticsQueryRequest $request, $filters)
    {
        $filterArray = [];
        foreach ($filters as $filterItem) {
            if (strlen($filterItem['expression']) === 0) {
                continue;
            }
            $filter = new Google_Service_Webmasters_ApiDimensionFilter();
            $filter->setDimension($filterItem['dimension']);
            $filter->setOperator($filterItem['operator']);
            $filter->setExpression($filterItem['expression']);
            $filterArray[] = $filter;
        }

        if (count($filterArray)) {
            $filtergroup = new Google_Service_Webmasters_ApiDimensionFilterGroup();
            $filtergroup->setFilters($filterArray);
            $request->setDimensionFilterGroups([$filtergroup]);
        }

        return $request;
    }
}
