<?php

declare(strict_types=1);

namespace DrewRoberts\Blog;

use DrewRoberts\Blog\Models\Page;
use DrewRoberts\Blog\Models\Post;
use DrewRoberts\Blog\Models\Series;
use DrewRoberts\Blog\Models\Topic;
use DrewRoberts\Blog\Policies\PagePolicy;
use DrewRoberts\Blog\Policies\PostPolicy;
use DrewRoberts\Blog\Policies\SeriesPolicy;
use DrewRoberts\Blog\Policies\TopicPolicy;
use DrewRoberts\Blog\ViewCreators\LayoutViewCreator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Laravel\Nova\Nova;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class BlogServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $tipoffPackage): void
    {
        $tipoffPackage
            ->hasPolicies([
                Page::class => PagePolicy::class,
                Post::class => PostPolicy::class,
                Series::class => SeriesPolicy::class,
                Topic::class => TopicPolicy::class,
            ])
            ->hasNovaResources([
                \DrewRoberts\Blog\Nova\Page::class,
                \DrewRoberts\Blog\Nova\Post::class,
                \DrewRoberts\Blog\Nova\Series::class,
                \DrewRoberts\Blog\Nova\Topic::class,
                \DrewRoberts\Blog\Nova\Layout::class,
            ])
            ->hasWebRoute('web')
            ->hasViews()
            ->name('blog');
    }

    public function bootingPackage()
    {
        parent::bootingPackage();

        Nova::serving(function () {
            Nova::script('text-copy', __DIR__.'/../dist/js/field.js');
            Nova::style('text-copy', __DIR__.'/../dist/css/field.css');
        });

        Route::model('post', Post::class);

        View::creator('*', LayoutViewCreator::class);
    }

    public function registeringPackage()
    {
        parent::registeringPackage();

        $this->app->instance(LayoutManager::class, new LayoutManager);
        $this->app->alias(LayoutManager::class, 'layoutmanager');
    }
}
