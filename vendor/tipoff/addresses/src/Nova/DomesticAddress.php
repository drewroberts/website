<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Tipoff\Addresses\Nova\Fields\Address;
use Tipoff\Support\Nova\BaseResource;

class DomesticAddress extends BaseResource
{
    public static $model = \Tipoff\Addresses\Models\DomesticAddress::class;

    public static $search = [
        'id',
        'address_line_1',
    ];

    public static $title = 'address_line_1';

    public function subtitle()
    {
        return "{$this->city->title}, {$this->city->state->abbreviation} {$this->zip_code}";
    }

    public static $group = 'Resources';

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),

            Text::make('Address Line 1')->sortable(),

            nova('city') ? BelongsTo::make('City', 'city', nova('city'))->sortable() : null,

            nova('zip') ? BelongsTo::make('Zip', 'zip', nova('zip'))->sortable() : null,
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Address::make('Address', 'address_line_1')
                ->postalCode('zip_code'),

            Text::make('Address Line 1')->onlyOnDetail(),

            Text::make('Address Line 2')->nullable(),

            Text::make('City')->required()->onlyOnForms()->hideWhenUpdating(),

            Text::make('City', 'city', function () {
                return $this->city->title;
            })->required()->onlyOnForms()->hideWhenCreating(),

            Text::make('Zip', 'zip_code')->required()->onlyOnForms(),

            nova('city') ? BelongsTo::make('City', 'city', nova('city'))->searchable()->exceptOnForms() : null,

            nova('zip') ? BelongsTo::make('Zip', 'zip', nova('zip'))->searchable()->exceptOnForms() : null,

            nova('address') ? MorphOne::make('Address', 'address', nova('address')) : null,
        ]);
    }

    protected function dataFields(): array
    {
        return array_merge(
            parent::dataFields(),
            $this->creatorDataFields(),
            $this->updaterDataFields(),
        );
    }
}
