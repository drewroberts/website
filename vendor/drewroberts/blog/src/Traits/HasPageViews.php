<?php

namespace DrewRoberts\Blog\Traits;

trait HasPageViews
{
    public static function bootHasPageViews()
    {
        static::saving(static function ($model) {
            if (empty($model->attributes['pageviews'])) {
                $model->attributes['pageviews'] = 0;
            }
        });
    }
}
