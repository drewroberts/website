<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Tipoff\Support\Contracts\Sellable\Sellable;

interface OrderInterface extends BaseItemContainerInterface
{
    /**
     * Finds an existing cart item be Sellable type and Sellable defined item it.  Null is returned
     * if item is not found;
     *
     * @param Sellable $sellable
     * @param string $itemId
     * @return OrderItemInterface|null
     */
    public function findItem(Sellable $sellable, string $itemId): ?OrderItemInterface;

    /**
     * Get order number
     */
    public function getOrderNumber(): string;
}
