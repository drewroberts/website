<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Tipoff\Addresses\Models\Region;

class RegionFactory extends Factory
{
    protected $model = Region::class;

    public function definition()
    {
        $name = $this->faker->unique()->state;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'creator_id' => randomOrCreate(app('user')),
            'updater_id' => randomOrCreate(app('user')),
        ];
    }
}
