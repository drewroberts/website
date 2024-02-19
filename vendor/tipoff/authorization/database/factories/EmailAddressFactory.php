<?php

namespace Tipoff\Authorization\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Authorization\Models\EmailAddress;
use Illuminate\Support\Str;

class EmailAddressFactory extends Factory
{
    protected $model = EmailAddress::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
  
    public function verified()
    {
        return $this->state(function (array $attributes) {
            return [
                'verified_at' => now(),
            ];
        });
    }
}
