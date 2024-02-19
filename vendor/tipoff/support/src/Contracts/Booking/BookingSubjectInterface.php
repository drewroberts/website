<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Booking;

interface BookingSubjectInterface
{
    /**
     * Get label used in lists.
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Get timezone.
     *
     * @return string
     */
    public function getTimezone(): string;
}
