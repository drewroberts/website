<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\Models;

use DrewRoberts\Blog\Exceptions\HasChildrenException;
use DrewRoberts\Blog\Traits\HasPageViews;
use DrewRoberts\Media\Traits\HasMedia;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class Series extends BaseModel
{
    use HasCreator;
    use HasUpdater;
    use HasPackageFactory;
    use HasMedia;
    use HasPageViews;

    protected $table = 'series';

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Series $series) {
            throw_if($series->posts()->count(), HasChildrenException::class);
        });
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get a string path for the series.
     *
     * @return string
     * @todo use config file for alternate paths
     */
    public function getPathAttribute()
    {
        return "/{$this->topic->slug}/{$this->slug}";
    }

    public function topic()
    {
        return $this->belongsTo(app('topic'));
    }
    
    public function layout()
    {
        return $this->belongsTo(app('layout'));
    }

    public function posts()
    {
        return $this->hasMany(app('post'));
    }
}
