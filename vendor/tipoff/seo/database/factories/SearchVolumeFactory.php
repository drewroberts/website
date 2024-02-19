<?php

declare(strict_types=1);

namespace Tipoff\Seo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Seo\Models\Keyword;
use Tipoff\Seo\Models\SearchVolume;

class SearchVolumeFactory extends Factory
{
    protected $model = SearchVolume::class;

    public function definition()
    {
        $dt = $this->faker->dateTimeBetween('-3 months', 'now');
        
        return [
            'engine'            => $this->faker->name,
            'provider'          => $this->faker->name,
            'keyword_id'        => Keyword::factory()->create()->id,
            'range'             => $this->faker->randomElement(['month', 'week', 'day']),
            'range_value'       => $dt->format("Y-m-d"),
            'queries'           => $this->faker->numberBetween(1, 1000),
            'clicks'            => $this->faker->numberBetween(1, 1000),
            'creator_id'        => randomOrCreate(app('user')),
            'updater_id'        => randomOrCreate(app('user')),
        ];
    }
}
