<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout\Discounts;

use Tipoff\Support\Contracts\Checkout\CodedCartAdjustment;
use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface DiscountInterface extends BaseModelInterface, CodedCartAdjustment
{
}
