<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Tipoff\Addresses\Models\Country;

class AddUsaCountry extends Migration
{
    public function up()
    {

        if (class_exists(Country::class)) {
            foreach ([
                [
                    'id' => 1,
                    'slug' => 'usa',
                    'title' => 'United States',
                    'official' => 'United States of America',
                    'abbreviation' => 'USA',
                    'cca2' => 'US',
                    'cioc' => 'USA',
                    'capital' => 'Washington D.C.',
                    'world_region' => 'Americas',
                    'world_subregion' => 'North America',
                    'area' => 9372610,
                    'independent' => true,
                    'un_member' => true,
                    'landlocked' => false,
                    'flag' => '\ud83c\uddfa\ud83c\uddf8',
                    'created_at' => '2021-03-03 02:08:35',
                    'updated_at' => '2021-03-03 02:08:35',
                ]
            ] as $country) {
                Country::firstOrCreate($country);
            }
        }
    }
}
