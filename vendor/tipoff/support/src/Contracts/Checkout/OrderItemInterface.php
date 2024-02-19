<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

interface OrderItemInterface extends BaseItemInterface
{
    /**
     * Get order containing this order item
     */
    public function getOrder(): ?OrderInterface;
}
