<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Booking;

interface BookingCategoryInterface
{
    /**
     * Get label used in lists.
     *
     * @return string
     */
    public function getLabel(): string;
}
