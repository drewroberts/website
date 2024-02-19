<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Tipoff\Addresses\Models\State;

class StateFactory extends Factory
{
    protected $model = State::class;

    public function definition()
    {
        // Can't use state since they are already migrated in database
        $title = $this->faker->unique()->city;

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'abbreviation' => $this->faker->unique()->lexify('X?'),
            'country_id' => randomOrCreate(app('country')),
        ];
    }
}
