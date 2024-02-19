<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Payment;

use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface RefundInterface extends BaseModelInterface
{
    /**
     * Create and persist a new refund for the amount indicated.  The created refund is NOT issued
     * until an explicit issue request occurs.
     */
    public static function createRefund(PaymentInterface $payment, int $amount, string $method): self;

    /**
     * Issue a pending refund, completing the refund process.
     */
    public function issue(): self;
}
