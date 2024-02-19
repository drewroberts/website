<?php

declare(strict_types=1);

namespace Tipoff\Seo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Seo\Models\PlaceHours;

class PlaceHoursFactory extends Factory
{
    protected $model = PlaceHours::class;

    public function definition()
    {
        return [
            'monday_open'              => $this->faker->text,
            'monday_close'             => $this->faker->text,
            'tuesday_open'             => $this->faker->text,
            'tuesday_close'            => $this->faker->text,
            'wednesday_open'           => $this->faker->text,
            'wednesday_close'          => $this->faker->text,
            'thursday_open'            => $this->faker->text,
            'thursday_close'           => $this->faker->text,
            'friday_open'              => $this->faker->text,
            'friday_close'             => $this->faker->text,
            'saturday_open'            => $this->faker->text,
            'saturday_close'           => $this->faker->text,
            'sunday_open'              => $this->faker->text,
            'sunday_close'             => $this->faker->text,
            'place_id'                 => randomOrCreate(app('place')),
            'creator_id'               => randomOrCreate(app('user')),
        ];
    }
}
