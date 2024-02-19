<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Taxes;

interface TaxRequest
{
    public static function createTaxRequest(): self;

    public function createTaxRequestItem(string $itemId, int $locationId, ?string $taxCode, int $amount): self;

    public function calculateTax(): self;

    public function getTaxRequestItem(string $itemId): ?TaxRequestItem;
}
