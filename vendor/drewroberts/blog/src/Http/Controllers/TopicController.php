<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\Http\Controllers;

use DrewRoberts\Blog\Facade\LayoutManager;
use DrewRoberts\Blog\Models\Topic;
use Illuminate\Http\Request;
use Tipoff\Support\Http\Controllers\BaseController;

class TopicController extends BaseController
{
    public function __invoke(Request $request, Topic $topic)
    {
        LayoutManager::setLayout($topic->layout);

        return view(LayoutManager::getViewName('blog::topic.base'), [
            'topic' => $topic,
        ]);
    }
}
