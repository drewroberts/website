<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Addresses\Models\Timezone;

class TimezoneFactory extends Factory
{
    protected $model = Timezone::class;

    public function definition()
    {
        $timezone = $this->faker->unique()->word;

        return [
            'name' => $timezone,
            'title' => $timezone,
            'php' => $timezone,
            'is_daylight_saving' => $this->faker->boolean
        ];
    }
}
