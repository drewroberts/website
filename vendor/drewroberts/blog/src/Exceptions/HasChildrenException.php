<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\Exceptions;

use Throwable;

class HasChildrenException extends \LogicException implements BlogException
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct('Cannot delete when children exist.', $code, $previous);
    }
}
