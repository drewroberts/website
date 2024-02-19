<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Tipoff\Addresses\Models\PhoneArea;

class PhoneAreaFactory extends Factory
{
    protected $model = PhoneArea::class;

    public function definition()
    {
        return [
            'code' => $this->faker->areaCode,
            'state_id' => randomOrCreate(app('state')),
            'note' => $this->faker->sentences(5),
            'creator_id' => randomOrCreate(app('user')),
            'updater_id' => randomOrCreate(app('user'))
        ];
    }
}
