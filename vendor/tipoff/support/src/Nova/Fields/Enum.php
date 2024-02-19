<?php

declare(strict_types=1);

namespace Tipoff\Support\Nova\Fields;

use Assert\Assert;
use Laravel\Nova\Fields\Select;
use Tipoff\Support\Enums\BaseEnum;

class Enum extends Select
{
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->resolveUsing(
            function ($value) {
                return $value instanceof \MabeEnum\Enum ? $value->getValue() : $value;
            }
        );

        $this->displayUsing(
            function ($value) {
                return $value instanceof BaseEnum ? $value->humanize() : $value;
            }
        );
    }

    public function attach(string $class): self
    {
        Assert::that($class)->subclassOf(BaseEnum::class);
        $options = call_user_func([$class, 'optionsArray']);

        return $this->options($options)
            ->rules(new \Tipoff\Support\Rules\Enum($class));
    }
}
