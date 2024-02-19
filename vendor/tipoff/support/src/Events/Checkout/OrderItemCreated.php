<?php

declare(strict_types=1);

namespace Tipoff\Support\Events\Checkout;

use Tipoff\Support\Contracts\Checkout\OrderItemInterface;

class OrderItemCreated extends SellableEvent
{
    public OrderItemInterface $orderItem;

    public function __construct(OrderItemInterface $orderItem)
    {
        parent::__construct($orderItem->getSellable());
        $this->orderItem = $orderItem;
    }
}
