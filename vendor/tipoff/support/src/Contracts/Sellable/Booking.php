<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Sellable;

interface Booking extends Sellable
{
    public function getParticipants(): int;
}
