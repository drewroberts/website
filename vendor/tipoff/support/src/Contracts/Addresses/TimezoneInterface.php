<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Addresses;

use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface TimezoneInterface extends BaseModelInterface
{
    /**
     * Return PHP timezone string
     *
     * @return string
     */
    public function getPhpTZ(): string;
}
