<?php

declare(strict_types=1);

namespace Tipoff\Seo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Seo\Models\Domain;
use Tipoff\Seo\Models\Webpage;

class WebpageFactory extends Factory
{
    protected $model = Webpage::class;

    public function definition()
    {
        return [
            'domain_id'         => Domain::factory()->create()->id,
            'path'              => $this->faker->slug,
            'creator_id'        => randomOrCreate(app('user')),
            'updater_id'        => randomOrCreate(app('user')),
        ];
    }
}
