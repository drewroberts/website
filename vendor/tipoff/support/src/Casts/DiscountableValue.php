<?php

declare(strict_types=1);

namespace Tipoff\Support\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DiscountableValue implements CastsAttributes
{
    private const DISCOUNTS_KEY_PATTERN = '%s_discounts';

    public function get($model, string $key, $value, array $attributes)
    {
        return (new \Tipoff\Support\Objects\DiscountableValue((int) ($attributes[$key] ?? ($value ?? 0))))
            ->addDiscounts((int) ($attributes[$this->getDiscountsKey($key)] ?? 0));
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            $value = new \Tipoff\Support\Objects\DiscountableValue(0);
        } elseif (is_int($value)) {
            $value = new \Tipoff\Support\Objects\DiscountableValue($value);
        }

        if ($value instanceof \Tipoff\Support\Objects\DiscountableValue) {
            return [
                $key => $value->getOriginalAmount(),
                $this->getDiscountsKey($key) => $value->getDiscounts(),
            ];
        }

        throw new \InvalidArgumentException('DiscountableValue class expected');
    }

    private function getDiscountsKey(string $key): string
    {
        return sprintf(self::DISCOUNTS_KEY_PATTERN, $key);
    }
}
