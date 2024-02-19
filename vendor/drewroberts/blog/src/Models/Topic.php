<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\Models;

use DrewRoberts\Blog\Exceptions\HasChildrenException;
use DrewRoberts\Blog\Exceptions\InvalidSlugException;
use DrewRoberts\Blog\Traits\HasPageViews;
use DrewRoberts\Media\Traits\HasMedia;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class Topic extends BaseModel
{
    use HasCreator;
    use HasUpdater;
    use HasPackageFactory;
    use HasMedia;
    use HasPageViews;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (Topic $topic) {
            $topic->validateSlug();
        });

        static::deleting(function (Topic $topic) {
            throw_if($topic->series()->count(), HasChildrenException::class);
        });
    }

    private function validateSlug(): void
    {
        InvalidSlugException::checkRootSlugRestrictions($this->slug);

        // Prevent topic from having same slug as root pages
        throw_if(Page::query()->whereNull('parent_id')->where('slug', '=', $this->slug)->count(), InvalidSlugException::class);

        // Prevent topic from having same slug as topics
        $count = Topic::query()
            ->where(function ($builder) {
                if ($this->id) {
                    $builder->where('id', '<>', $this->id);
                }
            })
            ->where('slug', '=', $this->slug)
            ->count();
        throw_if($count, InvalidSlugException::class);
    }

    public function getPathAttribute()
    {
        return "/{$this->slug}";
    }

    public function layout()
    {
        return $this->belongsTo(app('layout'));
    }

    public function series()
    {
        return $this->hasMany(app('series'));
    }

    public function posts()
    {
        return $this->hasManyThrough(app('post'), app('series'));
    }
}
