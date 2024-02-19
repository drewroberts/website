<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Tipoff\Addresses\Models\Phone;

class PhoneFactory extends Factory
{
    protected $model = Phone::class;

    public function definition()
    {
        $phone_area = randomOrCreate(app('phone_area'));
        $phone_area_code = $phone_area->code;
        $exchange_code = $this->faker->exchangeCode;
        $line_number = $this->faker->numerify('####');
        $full_number = $phone_area_code . $exchange_code . $line_number;

        return [
            'country_callingcode_id' => randomOrCreate(app('country_callingcode')),
            'full_number' => $full_number,
            'phone_area_code' => $phone_area_code,
            'exchange_code' => $exchange_code,
            'line_number' => $line_number,
            'creator_id' => randomOrCreate(app('user')),
            'updater_id' => randomOrCreate(app('user'))
        ];
    }
}
