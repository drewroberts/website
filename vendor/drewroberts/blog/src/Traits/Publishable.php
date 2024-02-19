<?php

namespace DrewRoberts\Blog\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Publishable
{
    public static function bootPublishable()
    {
        static::addGlobalScope('published', static function (Builder $builder) {
            $builder->where('published_at', '<=', now());
        });

        static::saving(static function ($publishable) {
            if (empty($publishable->attributes['published_at'])) {
                $publishable->attributes['published_at'] = now();
            }
        });
    }

    public function isPublished()
    {
        return $this->published_at->lessThanOrEqualTo(now());
    }
}
