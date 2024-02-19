<?php

declare(strict_types=1);

namespace Tipoff\Seo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Seo\Models\SearchLocale;

class SearchLocaleFactory extends Factory
{
    protected $model = SearchLocale::class;

    public function definition()
    {
        return [
            'serp_id'           => $this->faker->randomNumber(),
            'google_id'         => $this->faker->randomNumber(),
            'google_parent_id'  => $this->faker->randomNumber(),
            'name'              => $this->faker->name,
            'canonical_name'    => $this->faker->name,
            'country_code'      => $this->faker->countryCode,
            'target_type'       => 'DMA Region',
            'reach'             => $this->faker->randomNumber(),
            'latitude'          => $this->faker->latitude,
            'longitude'         => $this->faker->longitude,
            'creator_id'        => randomOrCreate(app('user')),
            'updater_id'        => randomOrCreate(app('user')),
        ];
    }
}
