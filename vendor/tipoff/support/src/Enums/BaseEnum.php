<?php

declare(strict_types=1);

namespace Tipoff\Support\Enums;

use Illuminate\Support\Str;
use MabeEnum\Enum;

/**
* @psalm-immutable
*/
abstract class BaseEnum extends Enum
{
    /**
     * @return array|mixed
     */
    public static function optionsArray()
    {
        $options = [];
        foreach (static::getEnumerators() as $value) {
            $options[$value->getValue()] = $value->humanize();
        }

        return $options;
    }

    public function humanize(): string
    {
        $value = (string) $this->getValue();

        /** @psalm-suppress ImpureMethodCall */
        return Str::title(Str::snake(Str::studly($value), ' '));
    }
}
