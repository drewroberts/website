<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Booking;

use Illuminate\Database\Eloquent\Relations\Relation;
use Tipoff\Support\Contracts\Scheduler\SlotInterface;

interface BookingSlotInterface extends SlotInterface
{
    /**
     * If slot is bookable.
     *
     * @return bool
     */
    public function isBookable(): bool;

    /**
     * Relationship with bookings.
     *
     * @return Relation
     */
    public function bookings(): Relation;
}
