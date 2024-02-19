<?php

declare(strict_types=1);

namespace Tipoff\Support\Objects;

class DiscountableValue
{
    // Plain Old Object - not model
    private int $originalAmount;
    private int $discounts;

    public function __construct(int $originalAmount)
    {
        $this->originalAmount = $originalAmount;
        $this->discounts = 0;
    }

    public function getOriginalAmount(): int
    {
        return $this->originalAmount;
    }

    public function getDiscounts(): int
    {
        return $this->discounts;
    }

    public function getDiscountedAmount(): int
    {
        return max(0, $this->getOriginalAmount() - $this->getDiscounts());
    }

    public function addDiscounts(int $discounts): DiscountableValue
    {
        $result = clone $this;
        $result->discounts += min($this->getDiscountedAmount(), $discounts);

        return $result;
    }

    public function reset(): DiscountableValue
    {
        return new static($this->originalAmount);
    }

    public function add(DiscountableValue $other): DiscountableValue
    {
        $result = clone $this;
        $result->originalAmount += $other->getOriginalAmount();

        return $result->addDiscounts($other->getDiscounts());
    }

    public function multiply(int $count): DiscountableValue
    {
        $result = clone $this;
        $result->originalAmount *= $count;
        $result->discounts *= $count;

        return $result;
    }

    public function isEqual(DiscountableValue $other): bool
    {
        return $this->originalAmount === $other->originalAmount &&
            $this->discounts === $other->discounts;
    }

    public function __toString()
    {
        return (string) $this->originalAmount;
    }
}
