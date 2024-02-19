<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Booking;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Relation;
use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface BookingInterface extends BaseModelInterface
{
    /**
     * Get timezone.
     *
     * @return string
     */
    public function getTimezone(): string;

    /**
     * Get label used in lists.
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Get booking description used in details.
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get booking date.
     *
     * @return Carbon
     */
    public function getDate(): Carbon;

    /**
     * Get slot.
     *
     * @return BookingSlotInterface
     */
    public function getSlot(): BookingSlotInterface;

    /**
     * Get amount in cents.
     *
     * @return int
     */
    public function getAmount(): int;

    /**
     * Get participants.
     *
     * @return Relation
     */
    public function participants(): Relation;

    /**
     * Booking subject.
     *
     * @return BookingSubjectInterface
     */
    public function getSubject(): BookingSubjectInterface;

    /**
     * Booking experience.
     *
     * @return BookingExperienceInterface
     */
    public function getExperience(): BookingExperienceInterface;

    /**
     * Relation with subject.
     *
     * @return Relation
     */
    public function subject(): Relation;

    /**
     * Relation with experience.
     *
     * @return Relation
     */
    public function experience(): Relation;
}
