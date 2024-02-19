<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\Http\Controllers;

use DrewRoberts\Blog\Models\Page;
use DrewRoberts\Blog\Models\Post;
use DrewRoberts\Blog\Models\Series;
use DrewRoberts\Blog\Models\Topic;
use Illuminate\Http\Request;
use Tipoff\Support\Http\Controllers\BaseController;

class BlogController extends BaseController
{
    public function __invoke(Request $request, string $slug1, ?string $slug2 = null, ?string $slug3 = null)
    {
        /** @var Topic $topic */
        if ($topic = Topic::query()->where('slug', '=', $slug1)->first()) {
            return $this->handleTopicRoute($request, $topic, $slug2, $slug3);
        }

        /** @var Page $page */
        if ($page = Page::query()->whereNull('parent_id')->where('slug', '=', $slug1)->first()) {
            return $this->handlePageRoute($request, $page, $slug2, $slug3);
        }

        abort(404);
    }

    private function handleTopicRoute(Request $request, Topic $topic, ?string $slug2 = null, ?string $slug3 = null)
    {
        if (empty($slug2)) {
            return app(TopicController::class)($request, $topic);
        }

        /** @var Series $series */
        if ($series = Series::query()
            ->where('topic_id', '=', $topic->id)
            ->where('slug', '=', $slug2)
            ->first()) {
            if (empty($slug3)) {
                return app(SeriesController::class)($request, $series);
            }

            /** @var Post $post */
            if ($post = Post::query()
                ->where('topic_id', '=', $topic->id)
                ->where('series_id', '=', $series->id)
                ->where('slug', '=', $slug3)
                ->first()) {
                return app(PostController::class)($request, $post, $series, $topic);
            }
        }

        // Valid topic, but invalid nesting of series or post slugs
        abort(404);
    }

    private function handlePageRoute(Request $request, Page $page, ?string $slug2 = null, ?string $slug3 = null)
    {
        if (empty($slug2)) {
            return app(PageController::class)($request, $page);
        }

        /** @var Page $childPage */
        if ($childPage = Page::query()
            ->where('parent_id', '=', $page->id)
            ->where('slug', '=', $slug2)
            ->first()) {
            if (empty($slug3)) {
                return app(PageController::class)($request, $page, $childPage);
            }

            /** @var Page $grandChildPage */
            if ($grandChildPage = Page::query()
                ->where('parent_id', '=', $childPage->id)
                ->where('slug', '=', $slug3)
                ->first()) {
                return app(PageController::class)($request, $page, $childPage, $grandChildPage);
            }
        }

        // Valid root page, but invalid nesting of pages
        abort(404);
    }
}
