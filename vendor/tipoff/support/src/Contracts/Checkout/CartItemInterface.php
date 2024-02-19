<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Carbon\Carbon;
use Tipoff\Support\Objects\DiscountableValue;

interface CartItemInterface extends BaseItemInterface
{
    /**
     * Get cart containing this cart item
     */
    public function getCart(): ?CartInterface;

    /**
     * Set item quantity
     */
    public function setQuantity(int $qty): self;

    /**
     * Set user friendly description
     */
    public function setDescription(string $description): self;

    /**
     * Set discountable amount for this cart item
     *
     * @param DiscountableValue|int $amount
     * @return $this
     */
    public function setAmountEach($amount): self;

    /**
     * Set tax charged for this order item
     */
    public function setTax(int $tax): self;

    /**
     * Set location for this cart item.  An exception is thrown if cart items
     * have different locations.
     */
    public function setLocationId(?int $locationId): self;

    /**
     * Set tax code for this item
     */
    public function setTaxCode(?string $taxCode): self;

    /**
     * Get/set expiration for this item
     */
    public function getExpiresAt(): Carbon;

    public function setExpiresAt(Carbon $expiresAt): self;

    /**
     * Get/set parent item for a bundled cart item.  For example, a booking fee
     * should have its parent set to the cart item for the pending booking.  This
     * ensures related items are handled as a unit.
     */
    public function setParentItem(?CartItemInterface $parent): self;
}
