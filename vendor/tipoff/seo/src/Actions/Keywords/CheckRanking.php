<?php

declare(strict_types=1);

namespace Tipoff\Seo\Actions\Keywords;

use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;
use Tipoff\LaravelSerpapi\Helpers\SerpApiSearch;
use Tipoff\Seo\Jobs\GetLocalResults;
use Tipoff\Seo\Jobs\GetOrganicResults;
use Tipoff\Seo\Jobs\GetVideoResults;
use Tipoff\Seo\Models\Keyword;
use Tipoff\Seo\Models\Ranking;

class CheckRanking
{
    public function __invoke(Keyword $keyword): void
    {
        $serp_api = app()->make(SerpApiSearch::class);
        $serp_api->set_serp_api_key(config('seo.serp_api_key'));

        // each keyword could belong to multiple search locales
        $keyword_search_locales = $keyword->searchLocales()->get();

        foreach ($keyword_search_locales as $search_locale) {
            $query = [
                "q" => $keyword->phrase,
                "hl" => "en",
                "gl" => "us",
                "location" => $search_locale->serp_id,
                //"ludocid" => $search_locale->google_id,
            ];
            $response_data = $serp_api->search('json', $query);

            // create a new ranking per keyword-search_locale combination
            $ranking = new Ranking([
                'engine' => "google",
                'provider' => "serpapi",
                'keyword_id' => $keyword->id,
                'search_locale_id' => $search_locale->id,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            $ranking->save();

            try {
                Bus::chain([
                    new GetOrganicResults($response_data, $ranking->id),
                    new GetLocalResults($response_data, $ranking->id, $keyword->phrase), // only support domestic results at the moment
                    new GetVideoResults($response_data, $ranking->id, $search_locale->id),

                ])->dispatch();
            } catch (\Exception $e) {
                echo $e->getMessage()."\n";
            }
        }
    }
}
