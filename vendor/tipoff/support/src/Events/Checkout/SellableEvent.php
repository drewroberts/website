<?php

declare(strict_types=1);

namespace Tipoff\Support\Events\Checkout;

use Tipoff\Support\Contracts\Sellable\Sellable;
use Tipoff\Support\Events\BaseEvent;

abstract class SellableEvent extends BaseEvent
{
    public Sellable $sellable;

    public function __construct(Sellable $sellable)
    {
        $this->sellable = $sellable;
    }

    public function isA(string $class)
    {
        return get_class($this->sellable) === $class;
    }
}
