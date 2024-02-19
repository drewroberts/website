<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Tipoff\Support\Contracts\Sellable\Sellable;
use Tipoff\Support\Objects\DiscountableValue;

interface CartInterface extends BaseItemContainerInterface
{
    /**
     * Resolve a route name to an url, using a package default if the route doesn't exist.
     *
     * @param string $name
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    public static function route(string $name, array $parameters = [], bool $absolute = true): string;

    /**
     * Retrieve or create the current active cart for the given user.
     *
     * @param int $emailAddressId
     * @return static
     */
    public static function activeCart(int $emailAddressId): self;

    /**
     * Creates a new, DETACHED, cart item with required information.  Use `upsertItem` to attach
     * the created item to a cart.
     *
     * @param string $itemId
     * @param Sellable $sellable
     * @param DiscountableValue|int $amount
     * @param int $quantity
     * @return CartItemInterface
     */
    public static function createItem(Sellable $sellable, string $itemId, $amount, int $quantity = 1): CartItemInterface;

    /**
     * Performs an upsertItem on the activeCart when emailAddressId is provided.  When emailAddressId is not provided,
     * the cartItem is stored in session data.  When/if a login event is raised, the cartItem in session data will
     * be moved to the logged in users cart.
     *
     * @param CartItemInterface $cartItem
     * @param int|null $emailAddressId
     * @return CartItemInterface
     */
    public static function queuedUpsertItem(CartItemInterface $cartItem, ?int $emailAddressId = null): CartItemInterface;

    /**
     * Adds a newly created cart item to the cart or indicates an existing item has been changed. Item is validated as
     * part of the operation.  A CartItemCreated or CartItemUpdated event is dispatched depending on the actual
     * operation performed.
     *
     * @param CartItemInterface $cartItem
     * @return CartItemInterface
     */
    public function upsertItem(CartItemInterface $cartItem): CartItemInterface;

    /**
     * Finds an existing cart item be Sellable type and Sellable defined item it.  Null is returned
     * if item is not found;
     *
     * @param Sellable $sellable
     * @param string $itemId
     * @return CartItemInterface|null
     */
    public function findItem(Sellable $sellable, string $itemId): ?CartItemInterface;

    /**
     * Remove an item from the cart by its Sellable defined item id.  If an item is removed, a CartItemRemoved
     * event is dispatched.
     *
     * @param Sellable $sellable
     * @param string $itemId
     * @return $this
     */
    public function removeItem(Sellable $sellable, string $itemId): self;

    /**
     * Set methods for discountable shipping fee.
     *
     * @param DiscountableValue|int $shipping
     * @return $this
     */
    public function setShipping($shipping): self;

    /**
     * Update methods for container level discounts.
     */
    public function addDiscounts(int $amount): self;

    /**
     * Get/Update methods for credits pending redemption.
     */
    public function addCredits(int $amount): self;

    public function getCredits(): int;

    /**
     * Applies a coded discount or coded voucher to the cart.  An exception is thrown
     * if the coded discount or voucher is not valid or not found.
     */
    public function applyCode(string $code): self;

    /**
     * Set unique location established for cart via its items (if any)
     */
    public function setLocationId(?int $locationId): self;

    /**
     * Returns balance owned in cents.
     */
    public function getBalanceDue(): int;

    /**
     * Verify cart can be purchased.  Exception thrown if not valid.
     *
     * CartItemPurchaseVerification events are dispatched allowing Sellable an
     * opportunity for a final inventory or validity check.
     */
    public function verifyPurchasable(): self;

    /**
     * Transactional conversion of cart into an order, completing the purchase
     *
     * OrderItemCreated events are dispatched for each new OrderItem allowing
     * Sellable limited ability to modify the newly created OrderItem.
     *
     * An OrderCreated event is dispatched just before committing the transaction.
     */
    public function completePurchase(): OrderInterface;

    /**
     * Transactional completion of purchase with payment.
     * - verifies cart is purchasable
     * - verifies payment can be created
     * - creates order from cart
     */
    public function purchase($paymentMethod): OrderInterface;
}
