<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\Database\Factories;

use DrewRoberts\Blog\Models\Layout;
use DrewRoberts\Blog\Models\Series;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeriesFactory extends Factory
{
    protected $model = Series::class;

    public function definition()
    {
        $view = $this->faker->numberBetween(0, 1) === 0 ? 'blog::series.base' : 'blog::series.amp';
        $layout = Layout::where('view',$view)->first();

        $word = $this->faker->unique()->word;

        return [
            'slug'              => Str::slug($word),
            'title'             => $word,
            'layout_id'         => $layout->id,
            'note'              => $this->faker->sentences(1, true),
            'description'       => $this->faker->sentences(1, true),
            'pageviews'         => $this->faker->numberBetween(0, 5000),
            'topic_id'          => randomOrCreate(app('topic')),
            'image_id'          => randomOrCreate(app('image')),
            'ogimage_id'        => randomOrCreate(app('image')),
            'video_id'          => randomOrCreate(app('video')),
            'creator_id'        => randomOrCreate(app('user')),
            'updater_id'        => randomOrCreate(app('user'))
        ];
    }
}
