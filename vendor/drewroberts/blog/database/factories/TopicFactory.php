<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\Database\Factories;

use DrewRoberts\Blog\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use DrewRoberts\Blog\Models\Layout;

class TopicFactory extends Factory
{
    protected $model = Topic::class;

    public function definition()
    {
        $view = $this->faker->numberBetween(0, 1) === 0 ? 'blog::topic.base' : 'blog::topic.amp';
        $layout = Layout::where('view',$view)->first();

        $word = $this->faker->unique()->word;

        return [
            'slug'              => Str::slug($word),
            'title'             => $word,
            'layout_id'         => $layout->id,
            'description'       => $this->faker->sentences(1, true),
            'note'              => $this->faker->sentences(1, true),
            'pageviews'         => $this->faker->numberBetween(1, 400),
            'creator_id'        => randomOrCreate(app('user')),
            'updater_id'        => randomOrCreate(app('user'))
        ];
    }
}
