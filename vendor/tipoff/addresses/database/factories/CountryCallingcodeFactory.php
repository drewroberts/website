<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Tipoff\Addresses\Models\CountryCallingcode;

class CountryCallingcodeFactory extends Factory
{
    protected $model = CountryCallingcode::class;

    public function definition()
    {
        $code = $this->faker->numerify('######');
        $display = '+'.substr($code, 0, 3).substr($code, 3, 0);
        $root = '+'.substr($code, 0, 1);
        $suffix = substr($code, 1, 0);

        return [
            'country_id' => randomOrCreate(app('country')),
            'code' => $code,
            'display' => $display,
            'root' => $root,
            'suffix' => $suffix,
            'creator_id' => randomOrCreate(app('user')),
            'updater_id' => randomOrCreate(app('user'))
        ];
    }
}
