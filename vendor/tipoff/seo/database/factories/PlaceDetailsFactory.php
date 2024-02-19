<?php

declare(strict_types=1);

namespace Tipoff\Seo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Seo\Models\PlaceDetails;

class PlaceDetailsFactory extends Factory
{
    protected $model = PlaceDetails::class;

    public function definition()
    {
        return [
            'place_id'              => randomOrCreate(app('place')),
            'name'                  => $this->faker->name,
            'domestic_address_id'   => randomOrCreate(app('domestic_address')),
            'phone_id'              => randomOrCreate(app('phone')),
            'webpage_id'            => randomOrCreate(app('webpage')),
            'opened_at'             => $this->faker->date,
            'latitude'              => $this->faker->latitude,
            'longitude'             => $this->faker->longitude,
        ];
    }
}
