<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Tipoff\Addresses\Models\City;

class CityFactory extends Factory
{
    protected $model = City::class;

    public function definition()
    {
        $title = $this->faker->unique()->city;

        return [
            'state_id' => randomOrCreate(app('state')),
            'title' => $title,
            'timezone_id' => randomOrCreate(app('timezone')),
        ];
    }
}
