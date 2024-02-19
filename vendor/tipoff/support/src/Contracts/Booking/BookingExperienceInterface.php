<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Booking;

interface BookingExperienceInterface
{
    /**
     * Get label used in lists.
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Get experience id.
     *
     * @return mixed
     */
    public function getId();

    /**
     * Get experience type.
     *
     * @return string
     */
    public function getType(): string;
}
