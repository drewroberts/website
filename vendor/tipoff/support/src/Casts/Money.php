<?php

declare(strict_types=1);

namespace Tipoff\Support\Casts;

use Brick\Money\Currency;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Money implements CastsAttributes
{
    /** @var Currency */
    private $currency;

    public function __construct(string $currency = 'USD')
    {
        $this->currency = Currency::of($currency);
    }

    public function get($model, string $key, $value, array $attributes)
    {
        return is_null($value) ? $value : \Brick\Money\Money::ofMinor($value, $this->currency);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return $value;
        }

        if ($value instanceof \Brick\Money\Money) {
            return $value->getUnscaledAmount()->toInt();
        }

        throw new \InvalidArgumentException('Money class expected');
    }
}
