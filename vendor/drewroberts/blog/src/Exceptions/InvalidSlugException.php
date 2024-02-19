<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\Exceptions;

use Laravel\Nova\Nova;
use Throwable;

class InvalidSlugException extends \LogicException implements BlogException
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct('Slug is not allowed.', $code, $previous);
    }

    public static function checkRootSlugRestrictions(string $slug)
    {
        // Prevent root pages from conflicting with Nova and other fixed root segments
        $restrictions = [
            trim(Nova::path(), '/'),
            'nova-api',
            'nova-vendor',
            'blog',
        ];

        throw_if(in_array($slug, $restrictions), static::class);
    }
}
