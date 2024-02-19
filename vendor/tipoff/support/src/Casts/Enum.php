<?php

declare(strict_types=1);

namespace Tipoff\Support\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Enum implements CastsAttributes
{
    /** @var string */
    private $enumClass;

    public function __construct(string $enumClass)
    {
        $this->enumClass = $enumClass;
    }

    public function get($model, string $key, $value, array $attributes)
    {
        return is_null($value) ? $value : call_user_func([$this->enumClass, 'byValue'], $value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return $value;
        }

        if (is_string($value)) {
            $value = call_user_func([$this->enumClass, 'byValue'], $value);
        }

        if ($value instanceof \MabeEnum\Enum) {
            return $value->getValue();
        }

        throw new \InvalidArgumentException('Enum class expected');
    }
}
