<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Locations;

use Tipoff\Support\Contracts\Addresses\TimezoneInterface;
use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface LocationInterface extends BaseModelInterface
{
    /**
     * Return timezone interface.
     *
     * @return TimezoneInterface
     */
    public function getTimezone(): TimezoneInterface;
}
