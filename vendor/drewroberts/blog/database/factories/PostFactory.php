<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\Database\Factories;

use DrewRoberts\Blog\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use DrewRoberts\Blog\Models\Layout;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $view = $this->faker->numberBetween(0, 1) === 0 ? 'blog::post.base' : 'blog::post.amp';
        $layout = Layout::where('view',$view)->first();

        $word1 = $this->faker->name;
        $word2 = $this->faker->word;

        return [
            'slug'             => Str::slug($word1 . $word2),
            'title'            => $word1 . $word2,
            'content'          => $this->faker->sentences(3, true),
            'description'      => $this->faker->sentences(1, true),
            'pageviews'        => $this->faker->numberBetween(1, 400),
            'series_id'        => randomOrCreate(app('series')),
            'image_id'         => randomOrCreate(app('image')),
            'ogimage_id'       => randomOrCreate(app('image')),
            'video_id'         => randomOrCreate(app('video')),
            'author_id'        => randomOrCreate(app('user')),
            'creator_id'       => randomOrCreate(app('user')),
            'updater_id'       => randomOrCreate(app('user')),
            'layout_id'        => $layout->id,
            'published_at'     => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = '-1 days', $timezone = null)
        ];
    }

    public function unpublished()
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => $this->faker->dateTimeBetween($startDate = '+1 days', $endDate = '+1 years', $timezone = null)
            ];
        });
    }
}
