<?php

declare(strict_types=1);

namespace Tipoff\Support\Enums;

/**
 * @method static AppliesTo ORDER()
 * @method static AppliesTo PARTICIPANT()
 * @method static AppliesTo SINGLE_PARTICIPANT()
 * @method static AppliesTo BOOKING()
 * @method static AppliesTo PRODUCT()
 * @method static AppliesTo BOOKING_AND_PRODUCT()

 * @psalm-immutable
 */
class AppliesTo extends BaseEnum
{
    const ORDER = 'order';
    const PARTICIPANT = 'participant';
    const SINGLE_PARTICIPANT = 'single_participant';
    const BOOKING = 'booking';
    const PRODUCT = 'product';
    const BOOKING_AND_PRODUCT = 'each';
}
