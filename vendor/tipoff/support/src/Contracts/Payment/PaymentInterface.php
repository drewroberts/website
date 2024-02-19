<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Payment;

use Tipoff\Support\Contracts\Checkout\OrderInterface;
use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface PaymentInterface extends BaseModelInterface
{
    /**
     * Attempt to create new charge for the amount.  If the charge is successful, a new DETACHED Payment record is
     * created and returned.  When the order is available, it must be linked to the payment using `attachOrder(...)`
     * which will persist the payment record.
     */
    public static function createPayment(int $locationId, $chargeable, int $amount, $paymentMethod, string $source): self;

    /**
     * Attach an order to a detached Payment record, completing the payment process.
     */
    public function attachOrder(OrderInterface $order): self;

    /**
     * Request a refund for this payment.  The created refund must then be issued to complete the refund process.
     */
    public function requestRefund(int $amount, string $refundMethod): RefundInterface;
}
