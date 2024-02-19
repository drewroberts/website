<?php

declare(strict_types=1);

namespace Tipoff\Support\Events\Checkout;

use Tipoff\Support\Contracts\Checkout\OrderInterface;
use Tipoff\Support\Events\BaseEvent;

class OrderCreated extends BaseEvent
{
    public OrderInterface $order;

    public function __construct(OrderInterface $order)
    {
        $this->order = $order;
    }
}
