<?php

declare(strict_types=1);

namespace Tipoff\Seo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Support\Enums\AppliesTo;
use Tipoff\Seo\Models\BusinessCategory;
use Illuminate\Support\Str;

class BusinessCategoryFactory extends Factory
{
    protected $model = BusinessCategory::class;

    public function definition()
    {
        $name = $this->faker->unique()->jobTitle;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
