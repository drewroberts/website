<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Addresses\Models\DomesticAddress;

class DomesticAddressFactory extends Factory
{
    protected $model = DomesticAddress::class;

    public function definition()
    {
        return [
            'address_line_1' => $this->faker->streetAddress,
            'city_id' => randomOrCreate(app('city')),
            'zip_code' => randomOrCreate(app('zip')),
        ];
    }
}
