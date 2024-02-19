<?php

declare(strict_types=1);

namespace Tipoff\Support\Events\Checkout;

use Tipoff\Support\Contracts\Checkout\CartItemInterface;

class CartItemRemoved extends SellableEvent
{
    public CartItemInterface $cartItem;

    public function __construct(CartItemInterface $cartItem)
    {
        parent::__construct($cartItem->getSellable());
        $this->cartItem = $cartItem;
    }
}
