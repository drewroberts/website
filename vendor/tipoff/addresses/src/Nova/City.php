<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Tipoff\Support\Nova\BaseResource;

class City extends BaseResource
{
    public static $model = \Tipoff\Addresses\Models\City::class;

    public static $title = 'title';

    public static $search = [
        'id', 'title',
    ];

    public static $with = [
        'state',
        'timezone',
    ];

    public function title()
    {
        return $this->title.", ".$this->state->title;
    }

    public static $group = 'Resources';

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            Text::make('Title')->sortable(),
            Text::make('State', 'state_id', function () {
                return $this->state->title;
            })->sortable(),
            Text::make('Timezone', 'timezone_id', function () {
                return $this->timezone->title ?? null;
            })->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Title')->required(),
            Text::make('Slug')->required(),
            nova('state') ? BelongsTo::make('State', 'state', nova('state'))->searchable() : null,
            nova('timezone') ? BelongsTo::make('Timezone', 'timezone', nova('timezone'))->searchable() : null,
            Select::make('Importance')->options([
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ])->displayUsingLabels()->sortable(),

            // Create more panels with the fields below

            Boolean::make('Incorporated')->required()->default(true),
            Boolean::make('Military')->required()->default(true),
            Boolean::make('Township')->required()->default(true),

            Number::make('Latitude')->step(0.000001)->nullable(),
            Number::make('Longitude')->step(0.000001)->nullable(),

            Number::make('Population')->nullable(),
            Number::make('Population Proper')->nullable(),
            Number::make('Density')->nullable(),

            nova('zip') ? BelongsToMany::make('Zips', 'zips', nova('zip'))->searchable()
                ->fields(function () {
                    return [
                        Boolean::make('Primary')->required()->default(0),
                    ];
                }) : null,

            nova('domestic_address') ? HasMany::make('Domestic Addresses', 'domesticAddresses', nova('domestic_address')) : null,
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
