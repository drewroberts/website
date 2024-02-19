<?php

declare(strict_types=1);

namespace Tipoff\Seo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Seo\Models\Company;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        return [
            'name'                  => $this->faker->name,
            'slug'                  => $this->faker->slug,
            'domestic_address_id'   => randomOrCreate(app('domestic_address')),
            'phone_id'              => randomOrCreate(app('phone')),
            'creator_id'            => randomOrCreate(app('user')),
            'updater_id'            => randomOrCreate(app('user')),
        ];
    }
}
