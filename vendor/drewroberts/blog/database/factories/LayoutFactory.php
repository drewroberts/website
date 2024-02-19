<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\Database\Factories;

use DrewRoberts\Blog\Models\Layout;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Support\Enums\LayoutType;

class LayoutFactory extends Factory
{
    protected $model = Layout::class;

    public function definition()
    {
        $word = $this->faker->unique()->word;

        return [
            'name'              => $word,
            'layout_type'       => $this->faker->randomElement(LayoutType::getEnumerators()),
            'view'              => $word,
            'note'              => $this->faker->sentences(1, true),
            'creator_id'        => randomOrCreate(app('user')),
            'updater_id'        => randomOrCreate(app('user'))
        ];
    }
}
