<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout\Filters;

use Carbon\Carbon;

interface CreatedAtFilter extends BaseFilter
{
    /**
     * @param Carbon|string $startDate
     * @return $this
     */
    public function byStartDate($startDate): self;

    /**
     * @param Carbon|string $endDate
     * @return $this
     */
    public function byEndDate($endDate): self;

    public function yesterday(): self;

    public function yesterdayComparison(): self;

    public function week(): self;

    public function weekComparison(): self;
}
