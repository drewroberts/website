<?php

declare(strict_types = 1);

namespace Tipoff\Seo\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;
use Tipoff\Addresses\Models\Country;
use Tipoff\Addresses\Models\CountryCallingcode;
use Tipoff\Addresses\Models\DomesticAddress;
use Tipoff\Addresses\Models\Phone;
use Tipoff\LaravelSerpapi\Helpers\SerpApiSearch;
use Tipoff\Seo\Models\Company;
use Tipoff\Seo\Models\Domain;
use Tipoff\Seo\Models\Place;
use Tipoff\Seo\Models\PlaceDetails;
use Tipoff\Seo\Models\PlaceHours;
use Tipoff\Seo\Models\Result;
use Tipoff\Seo\Models\Webpage;

class GetLocalResults implements ShouldQueue
{
    use InteractsWithQueue;
    use Queueable;
    use Dispatchable;

    private $keyword;
    private $response_data;
    private $ranking_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($responseData, $rankingId, $keyword)
    {
        $this->keyword = $keyword;
        $this->response_data = $responseData;
        $this->ranking_id = $rankingId;
    }

    protected function getSelectDayHours($day_hours)
    {
        if ($day_hours == 'Closed') {
            return ['open' => 'Closed', 'close' => 'Closed'];
        }
        if ($day_hours == 'Open 24 hours') {
            return ['open' => '24 hours', 'close' => null];
        }
        $day_hours = str_replace("–", "-", $day_hours); // replace emdash with endash
        $day_times_arr = explode("-", $day_hours);
        $day_open = $day_times_arr[0];
        $day_close = $day_times_arr[1];
        if ($day_open != 'Closed' && strpos($day_open, 'AM') == false && strpos($day_open, 'PM') == false) {
            $day_open .= substr($day_close, -2); // get either AM or PM from close time
        }

        return ['open' => $day_open, 'close' => $day_close];
    }

    protected function getBusinessHours($week_hours)
    {
        $hours_result = [];
        foreach ($week_hours as $day_obj) {
            $day_arr = get_object_vars($day_obj);
            foreach ($day_arr as $day => $time) {
                $open_index = $day . '_open';
                $close_index = $day . '_close';
                $value = $this->getSelectDayHours($time);
                $hours_result[$open_index] = $value['open'];
                $hours_result[$close_index] = $value['close'];
            }
        }

        return $hours_result;
    }

    protected function getGoogleMapsPlace($title, $latitude, $longitude)
    {
        // query to get place address and hours from Google Maps API
        $serp_api = app()->make(SerpApiSearch::class);
        $serp_api->set_serp_api_key(config('seo.serp_api_key'));
        $query = [
            "engine" => "google_maps",
            "hl" => "en",
            "gl" => "us",
            "q" => $title,
            //"lsig" => $local_result->lsig,
            "ll" => "@$latitude,$longitude,10z", // 10z represents zoom level 10 which is default for google maps
            "type" => "search",
        ];
        $place_data_result = $serp_api->search('json', $query);
        if (! isset($place_data_result) || empty($place_data_result)) {
            // try zoom level 4
            $query = [
                "engine" => "google_maps",
                "hl" => "en",
                "gl" => "us",
                "q" => $title,
                "ll" => "@$latitude,$longitude,4z",
                "type" => "search",
            ];
            $place_data_result = $serp_api->search('json', $query);
        }

        return $place_data_result;
    }

    public function handle()
    {
        if (isset($this->response_data->local_results) && isset($this->response_data->local_results->places)) {
            foreach ($this->response_data->local_results->places as $local_result) {
                $place = Place::where('place_location', $local_result->place_id)->first();

                if ($place == null && isset($local_result->gps_coordinates)) {
                    $latitude = $local_result->gps_coordinates->latitude;
                    $longitude = $local_result->gps_coordinates->longitude;
                    $domestic_address_id = $place_hours = $webpage = null;
                    $country = 'United States';

                    $place_data_result = $this->getGoogleMapsPlace($local_result->title, $latitude, $longitude);

                    // check if api found place details
                    if (isset($place_data_result->place_results)) {
                        $searched_place = $place_data_result->place_results;
                        if (isset($searched_place->hours) && is_array($searched_place->hours)) {
                            $searched_place_hours = $this->getBusinessHours($searched_place->hours);
                            $place_hours = new PlaceHours([
                                'monday_open' => isset($searched_place_hours['monday_open']) ? $searched_place_hours['monday_open'] : null,
                                'monday_close' => isset($searched_place_hours['monday_close']) ? $searched_place_hours['monday_close'] : null,
                                'tuesday_open' => isset($searched_place_hours['tuesday_open']) ? $searched_place_hours['tuesday_open'] : null,
                                'tuesday_close' => isset($searched_place_hours['tuesday_close']) ? $searched_place_hours['tuesday_close'] : null,
                                'wednesday_open' => isset($searched_place_hours['wednesday_open']) ? $searched_place_hours['wednesday_open'] : null,
                                'wednesday_close' => isset($searched_place_hours['wednesday_close']) ? $searched_place_hours['wednesday_close'] : null,
                                'thursday_open' => isset($searched_place_hours['thursday_open']) ? $searched_place_hours['thursday_open'] : null,
                                'thursday_close' => isset($searched_place_hours['thursday_close']) ? $searched_place_hours['thursday_close'] : null,
                                'friday_open' => isset($searched_place_hours['friday_open']) ? $searched_place_hours['friday_open'] : null,
                                'friday_close' => isset($searched_place_hours['friday_close']) ? $searched_place_hours['friday_close'] : null,
                                'saturday_open' => isset($searched_place_hours['saturday_open']) ? $searched_place_hours['saturday_open'] : null,
                                'saturday_close' => isset($searched_place_hours['saturday_close']) ? $searched_place_hours['saturday_close'] : null,
                                'sunday_open' => isset($searched_place_hours['sunday_open']) ? $searched_place_hours['sunday_open'] : null,
                                'sunday_close' => isset($searched_place_hours['sunday_close']) ? $searched_place_hours['sunday_close'] : null,
                            ]);
                        }
                        if (isset($searched_place->address)) {
                            $street1 = $street2 = null;

                            try {
                                // e.g. $address = '555 Test Drive, Testville, CA 98773';
                                if (substr_count($searched_place->address, ",") == 2) {
                                    list($street1, $city, $statezip) = explode(", ", $searched_place->address);
                                }
                                // e.g. $address = 'NW Suite N2, 200 Peachtree St, Atlanta, GA 30303';
                                elseif (substr_count($searched_place->address, ",") == 3) {
                                    list($street1, $street2, $city, $statezip) = explode(", ", $searched_place->address);
                                }
                                // e.g. $address = '1030 Randolph Street, Detroit, MI 48226, United States';
                                elseif (substr_count($searched_place->address, ",") == 5) {
                                    list($street1, $street2, $city, $statezip, $country) = explode(", ", $searched_place->address);
                                }
                                if ($country == 'United States') {
                                    list($state, $zip) = explode(" ", $statezip);
                                    unset($state);
                                    $domestic_address = DomesticAddress::createDomesticAddress($street1, $street2, $city, $zip);
                                    $domestic_address_id = $domestic_address->id;
                                }
                            } catch (\Exception $e) {
                                //echo $searched_place->address . "\n";
                            }
                        }
                    } else {
                        //echo "Address/Hours not found for place: $place->title\n";
                    }

                    if (isset($searched_place->website)) {
                        $url = $searched_place->website;

                        try {
                            $url_array = parseUrl($url);
                        } catch (\Exception $e) {
                            echo $e->getMessage()."\n";

                            continue;
                        }
                        $domain = Domain::firstOrCreate(
                            [
                                    'name' => $url_array['name'],
                                    'tld' => $url_array['tld'],
                                    'https' => $url_array['https'],
                                    'subdomain' => $url_array['subdomain'],
                                        ],
                            ['created_at' => Carbon::now()->format('Y-m-d H:i:s')]
                        );

                        $webpage = Webpage::firstOrCreate(
                            [
                                    'domain_id' => $domain->id,
                                    'path' => Webpage::getUrlPath($url),
                                    'subdomain' => $url_array['subdomain'],
                                        ],
                            ['created_at' => Carbon::now()->format('Y-m-d H:i:s')]
                        );
                    }

                    if (isset($searched_place->phone) && $country == 'United States') {
                        $country_id = Country::fromAbbreviation('USA')->getId();
                        $country_calling_code = CountryCallingcode::where('country_id', $country_id)->first();
                        $phone = Phone::firstOrCreate(
                            [
                                    'country_callingcode_id' => $country_calling_code->id,
                                    'full_number' => $searched_place->phone,
                                        ],
                            ['created_at' => Carbon::now()->format('Y-m-d H:i:s')]
                        );
                    }

                    /*$company = new Company([
                        'name' => $local_result->title,
                        'slug' => Str::slug($local_result->title),
                        'domestic_address_id' => $domestic_address_id,
                        'phone_id' => (isset($phone->id)) ? $phone->id : null,
                    ]);
                    $company->save();
                    */

                    $company = Company::firstOrCreate(
                        [
                                'name' => $local_result->title,
                                'slug' => Str::slug($local_result->title),
                            ],
                        [
                                'domestic_address_id' => $domestic_address_id,
                                'phone_id' => (isset($phone->id)) ? $phone->id : null,
                            ]
                    );

                    $place = new Place([
                        'place_location' => $local_result->place_id,
                        'name' => $local_result->title,
                        'company_id' => $company->id,
                        'webpage_id' => (isset($webpage->id)) ? $webpage->id : null,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);
                    $place->save();

                    if ($place_hours != null) {
                        $place_hours->place_id = $place->id;
                        $place_hours->save();
                    }

                    $place_details = new PlaceDetails([
                        'place_id' => $place->id,
                        'name' => $local_result->title,
                        'domestic_address_id' => $domestic_address_id,
                        'webpage_id' => (isset($webpage->id)) ? $webpage->id : null,
                        'phone_id' => (isset($phone->id)) ? $phone->id : null,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);
                    $place_details->save();
                }
                $result = new Result([
                    'ranking_id' => $this->ranking_id,
                    'type' => 'Local',
                    'position' => $local_result->position,
                ]);
                $result->resultable()->associate($place);
                $result->save();
            }
        } else {
            throw new \Exception("Didn't get local results to parse.");
        }
    }
}
