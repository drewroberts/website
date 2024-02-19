<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Scheduler;

use Carbon\Carbon;
use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface SlotInterface extends BaseModelInterface
{
    /**
     * Resolve slot by number.
     *
     * @param  string $slotNumber
     * @return self
     */
    public function resolveSlot($slotNumber): self;

    /**
     * Check if slot has locks.
     *
     * @return bool
     */
    public function hasHold(): bool;

    /**
     * Get hold for slot.
     *
     * @return object|null
     */
    public function getHold();

    /**
     * Relese slot hold.
     *
     * @return self
     */
    public function releaseHold(): self;

    /**
     * Find slots active at time range (UTC).
     *
     * @param string $initialTime
     * @param string $finalTime
     * @return bool
     */
    public function isActiveAtTimeRange($initialTime, $finalTime): bool;

    /**
     * Get timezone.
     *
     * @return string
     */
    public function getTimezone(): string;

    /**
     * Get local time.
     *
     * @return Carbon
     */
    public function getTime(): Carbon;

    /**
     * Get label used in lists.
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Get booking date.
     *
     * @return Carbon
     */
    public function getDate(): Carbon;

    /**
     * Get start at.
     *
     * @return Carbon
     */
    public function getStartAt(): Carbon;

    /**
     * Get end at.
     *
     * @return Carbon
     */
    public function getEndAt(): Carbon;

    /**
     * If slot is virtual (not stored).
     *
     * @return bool
     */
    public function isVirtual(): bool;

    /**
     * Create hold.
     *
     * @param int $id For example user id.
     * @param Carbon|null $expiresAt
     * @return self
     */
    public function setHold($id, ?Carbon $expiresAt): self;
}
