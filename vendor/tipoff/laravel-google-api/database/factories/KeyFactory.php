<?php

declare(strict_types=1);

namespace Tipoff\GoogleApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\GoogleApi\Models\Key;

class KeyFactory extends Factory
{
    protected $model = Key::class;

    public function definition()
    {
        return [
            'slug' => $this->faker->unique()->slug,
            'value' => $this->faker->word,
            'creator_id'     => randomOrCreate(app('user')),
            'updater_id'     => randomOrCreate(app('user')),
        ];
    }
}
