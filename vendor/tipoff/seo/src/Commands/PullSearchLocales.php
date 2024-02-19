<?php

declare(strict_types=1);

namespace Tipoff\Seo\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use SerpApiSearch;
use Tipoff\Seo\Models\SearchLocale;

class PullSearchLocales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull:search_locales';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull all supported DMA Regions in the US and create their search locales';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Currently serpapi does not let you query by target type or get more than 10 records
        //$serp_api = app()->make(SerpApiSearch::class);

        // this file contains all supported locations used by serpapi ~30mb
        $supported_locations = json_decode(file_get_contents('https://serpapi.com/locations.json'), true);

        foreach ($supported_locations as $supported_location) {
            // United States will be the default Search Locale and then get all 210 of the DMA Regions in the US
            if ($supported_location['name'] == 'United States' || $supported_location['target_type'] == 'DMA Region') {
                $search_locale = SearchLocale::where('google_id', $supported_location['google_id'])->first();

                if ($search_locale === null) {
                    $search_locale = new SearchLocale([
                        'serp_id' => $supported_location['id'],
                        'google_id' => $supported_location['google_id'],
                        'google_parent_id' => $supported_location['google_parent_id'],
                        'name' => $supported_location['name'],
                        'canonical_name' => $supported_location['canonical_name'],
                        'country_code' => $supported_location['country_code'],
                        'target_type' => $supported_location['target_type'],
                        'reach' => $supported_location['reach'],
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);
                    if (isset($supported_location['gps']) && count($supported_location['gps']) == 2) {
                        $search_locale->latitude = $supported_location['gps'][0];
                        $search_locale->longitude = $supported_location['gps'][1];
                    }
                    $search_locale->save();
                }
            }
        }
    }
}
