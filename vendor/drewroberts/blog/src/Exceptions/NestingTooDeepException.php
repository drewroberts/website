<?php

declare(strict_types=1);

namespace DrewRoberts\Blog\Exceptions;

use Throwable;

class NestingTooDeepException extends \LogicException implements BlogException
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct('Cannot nest pages more than 3 levels deep.', $code, $previous);
    }
}
