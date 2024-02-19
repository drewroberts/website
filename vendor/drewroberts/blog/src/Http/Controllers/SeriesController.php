<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\Http\Controllers;

use DrewRoberts\Blog\Facade\LayoutManager;
use DrewRoberts\Blog\Models\Series;
use Illuminate\Http\Request;
use Tipoff\Support\Http\Controllers\BaseController;

class SeriesController extends BaseController
{
    public function __invoke(Request $request, Series $series)
    {
        LayoutManager::setLayout($series->layout);

        return view(LayoutManager::getViewName('blog::series.base'), [
            'topic' => $series->topic,
            'series' => $series,
        ]);
    }
}
