<?php

declare(strict_types=1);

namespace Tipoff\Seo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Seo\Models\Keyword;

class KeywordFactory extends Factory
{
    protected $model = Keyword::class;

    public function definition()
    {
        $array_type = ['Branded', 'Generic', 'Local'];
        $random_type = array_rand($array_type,2);

        return [
            'phrase'        => $this->faker->name,
            'type'          => $random_type[0],
            'creator_id'    => randomOrCreate(app('user')),
            'updater_id'    => randomOrCreate(app('user')),
        ];
    }
}
