<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\Facade;

use DrewRoberts\Blog\Models\Layout;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \DrewRoberts\Blog\LayoutManager setLayout(?Layout $layout)
 * @method static Layout getLayout()
 * @method static string getViewName(string $default)
 */
class LayoutManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'layoutmanager';
    }
}
