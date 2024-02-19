<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\Models;

use DrewRoberts\Blog\Traits\HasPageViews;
use DrewRoberts\Blog\Traits\Publishable;
use DrewRoberts\Media\Traits\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Mail\Markdown;
use Illuminate\Support\HtmlString;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class Post extends BaseModel
{
    use SoftDeletes;
    use HasCreator;
    use HasUpdater;
    use HasPackageFactory;
    use Publishable;
    use HasMedia;
    use HasPageViews;

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            // Can specify a different author for a post than Auth user
            $post->author_id = $post->author_id ?: auth()->user()->id;
            $post->topic_id = $post->series_id ? $post->series->topic_id : null;
        });
    }

    /**
     * @return HtmlString
     */
    public function getHtmlContentAttribute(): HtmlString
    {
        return Markdown::parse($this->content ?? '');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get a string path for the blog post.
     *
     * @return string
     */
    public function getPathAttribute(): string
    {
        if (! $this->series_id) {
            return route('post', ['post' => $this], false);
        }

        return "/{$this->topic->slug}/{$this->series->slug}/{$this->slug}";
    }
    
    public function layout()
    {
        return $this->belongsTo(app('layout'));
    }

    public function author()
    {
        return $this->belongsTo(app('user'), 'author_id');
    }

    public function topic()
    {
        return $this->belongsTo(app('topic'));
    }

    public function series()
    {
        return $this->belongsTo(app('series'));
    }
}
