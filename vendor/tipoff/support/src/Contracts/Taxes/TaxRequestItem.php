<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Taxes;

interface TaxRequestItem
{
    public function getItemId(): string;

    public function getLocationId(): int;

    public function getTaxCode(): ?string;

    public function getAmount(): int;

    public function setTaxDescription(?string $taxDescription): self;

    public function getTaxDescription(): ?string;

    public function setTax(int $tax): self;

    public function getTax(): int;
}
