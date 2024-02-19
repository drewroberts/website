<?php

declare(strict_types=1);

namespace Tipoff\Seo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Seo\Models\Keyword;
use Tipoff\Seo\Models\Ranking;
use Tipoff\Seo\Models\SearchLocale;
use Tipoff\Seo\Models\Webpage;

class RankingFactory extends Factory
{
    protected $model = Ranking::class;

    public function definition()
    {
        return [
            'engine'            => $this->faker->name,
            'provider'          => $this->faker->name,
            'keyword_id'        => Keyword::factory()->create()->id,
            'search_locale_id'  => SearchLocale::factory()->create()->id,
            'date'              => $this->faker->date,
            'creator_id'        => randomOrCreate(app('user')),
            'updater_id'        => randomOrCreate(app('user')),
        ];
    }
}
