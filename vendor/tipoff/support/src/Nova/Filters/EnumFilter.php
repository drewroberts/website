<?php

declare(strict_types=1);

namespace Tipoff\Support\Nova\Filters;

use Assert\Assert;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Nova;
use Tipoff\Support\Enums\BaseEnum;

class EnumFilter extends Filter
{
    protected string $column;

    protected string $class;

    public function __construct(string $column, string $class)
    {
        Assert::that($class)->subclassOf(BaseEnum::class);
        $this->column = $column;
        $this->class = $class;
    }

    public function name()
    {
        return $this->name ?: Nova::humanize($this->column);
    }

    public function apply(Request $request, $query, $value)
    {
        return $query->where($this->column, $value);
    }

    public function options(Request $request)
    {
        $options = call_user_func([$this->class, 'optionsArray']);

        return array_flip($options);
    }
}
