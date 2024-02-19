<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout\Filters;

interface ItemFilter extends CreatedAtFilter
{
    public function bySellableType(string $sellableType, bool $includeChildren = true): self;

    /**
     * @param mixed|int $location
     * @return $this
     */
    public function byLocation($location): self;
}
