<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\ViewCreators;

use DrewRoberts\Blog\LayoutManager;
use Illuminate\Contracts\View\View;

class LayoutViewCreator
{
    private $layoutManager;

    public function __construct(LayoutManager $layoutManager)
    {
        $this->layoutManager = $layoutManager;
    }

    public function create(View $view)
    {
        $view->with([
            'layout' => $this->layoutManager->getLayout(),
        ]);
    }
}
