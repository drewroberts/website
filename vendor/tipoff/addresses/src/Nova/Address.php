<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Tipoff\Addresses\Nova\Fields\PhoneNumber;
use Tipoff\Support\Nova\BaseResource;

class Address extends BaseResource
{
    public static $model = \Tipoff\Addresses\Models\Address::class;

    public static $title = 'id';

    public static $search = [
        'id',
        'first_name',
        'last_name',
        'type',
        'care_of',
        'company',
        'extended_zip',
    ];

    public static $group = 'Resources';

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            Text::make('Type')->sortable(),
            Text::make('First Name')->sortable(),
            Text::make('Last Name')->sortable(),
            Text::make('Care Of')->sortable(),
            Text::make('Company')->sortable(),
            Text::make('Extended Zip')->sortable(),
            PhoneNumber::make('Phone', 'phone', nova('phone'))->sortable(),
            MorphTo::make('Addressable')->types([
                DomesticAddress::class,
            ])->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            nova('domestic_address') ? BelongsTo::make('Domestic Addresses', 'domesticAddress', nova('domestic_address'))->required() : null,
            Text::make('Type'),
            Text::make('First Name')->nullable(),
            Text::make('Last Name')->nullable(),
            Text::make('Care Of')->nullable(),
            Text::make('Company')->nullable(),
            Text::make('Extended Zip')->nullable(),
            PhoneNumber::make('Phone', 'phone', nova('phone'))
                ->nullable()
                ->searchable()
                ->showAddPhoneNumberButton(),
            MorphTo::make('Addressable')->types([
                DomesticAddress::class,
            ]),
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
