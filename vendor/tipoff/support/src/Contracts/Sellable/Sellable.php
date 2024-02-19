<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Sellable;

use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface Sellable extends BaseModelInterface
{
    public function getDescription(): string;

    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     */
    public function getMorphClass();
}
