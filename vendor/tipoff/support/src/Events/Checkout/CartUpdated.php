<?php

declare(strict_types=1);

namespace Tipoff\Support\Events\Checkout;

use Tipoff\Support\Contracts\Checkout\CartInterface;
use Tipoff\Support\Events\BaseEvent;

class CartUpdated extends BaseEvent
{
    public CartInterface $cart;

    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }
}
