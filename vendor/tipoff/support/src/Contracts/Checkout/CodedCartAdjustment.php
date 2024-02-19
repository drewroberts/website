<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface CodedCartAdjustment extends BaseModelInterface
{
    /**
     * Locates an active adjustment by its code.  Null if nothing found.
     *
     * @param string $code
     * @return static|null
     */
    public static function findByCode(string $code);

    public static function calculateAdjustments(CartInterface $cart): void;

    /**
     * @param CartInterface $cart
     * @return array|CodedCartAdjustment[]
     */
    public static function getCodesForCart(CartInterface $cart): array;

    /**
     * @param OrderInterface $order
     * @return array|CodedCartAdjustment[]
     */
    public static function getCodesForOrder(OrderInterface $order): array;

    /**
     * @return string|null
     */
    public function getCode();

    /**
     * @return int|null
     */
    public function getAmount();

    /**
     * Associates adjustment with cart
     *
     * @param CartInterface $cart
     * @return static
     */
    public function applyToCart(CartInterface $cart);

    /**
     * Removes adjustment from cart
     *
     * @param CartInterface $cart
     * @return static
     */
    public function removeFromCart(CartInterface $cart);
}
