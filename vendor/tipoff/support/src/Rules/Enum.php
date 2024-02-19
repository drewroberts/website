<?php

declare(strict_types=1);

namespace Tipoff\Support\Rules;

use Illuminate\Contracts\Validation\Rule;

class Enum implements Rule
{
    /** @var string */
    private $enumClass;

    public function __construct(string $enumClass)
    {
        $this->enumClass = $enumClass;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return call_user_func([$this->enumClass, 'has'], $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not a valid value for ' . class_basename($this->enumClass) . '.';
    }
}
