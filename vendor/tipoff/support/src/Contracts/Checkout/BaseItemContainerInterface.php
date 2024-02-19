<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Illuminate\Support\Collection;
use Tipoff\Support\Contracts\Checkout\Filters\ItemFilter;
use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Models\UserInterface;
use Tipoff\Support\Objects\DiscountableValue;

interface BaseItemContainerInterface extends BaseModelInterface
{
    /**
     * Creates and returns an ItemFilter instance for constructing a collection of matching items
     */
    public static function itemFilter(): ItemFilter;

    /**
     * Returns the user that owns the container
     */
    public function getUser(): UserInterface;

    /**
     * Returns the DiscountableValue representing the total item amount / total item amount discounts
     */
    public function getItemAmountTotal(): DiscountableValue;

    /**
     * Returns tax in cents.
     */
    public function getTax(): int;

    /**
     * Get methods for discountable shipping fee.
     */
    public function getShipping(): DiscountableValue;

    /**
     * Get methods for container level discounts not reflected in item discounts
     */
    public function getDiscounts(): int;

    /**
     * Get unique location established for order via its items (if any)
     */
    public function getLocationId(): ?int;

    /**
     * Return a collection of items in the container
     */
    public function getItems(): Collection;
}
