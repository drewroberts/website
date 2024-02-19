<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout\Vouchers;

use Tipoff\Support\Contracts\Checkout\CodedCartAdjustment;
use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Models\UserInterface;

interface VoucherInterface extends BaseModelInterface, CodedCartAdjustment
{
    /**
     * Create a new Refund voucher for the user and amount indicated.
     */
    public static function createRefundVoucher(int $locationId, UserInterface $user, int $amount): self;
}
