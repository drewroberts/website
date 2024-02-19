<?php

declare(strict_types=1);

namespace Tipoff\Seo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Seo\Models\Result;

class ResultFactory extends Factory
{
    protected $model = Result::class;

    public function definition()
    {
        return [
            'ranking_id' => randomOrCreate(app('ranking')),
            'type' => $this->faker->randomElement(['Organic', 'Local', 'Ads', 'Inline Video']),
            'position' => $this->faker->unique(true)->numberBetween(1, 50),
        ];
    }
}
