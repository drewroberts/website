<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;

class Timezone extends BaseResource
{
    public static $model = \Tipoff\Addresses\Models\Timezone::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'name',
        'title',
    ];

    public static $group = 'Resources';

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            Text::make('Title')->sortable(),
            Text::make('Php')->sortable(),
            Boolean::make('Is daylight saving'),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Name')->required()->creationRules('unique:timezones,name'),
            Text::make('Title')->required()->creationRules('unique:timezones,title'),
            Text::make('Php')->required()->creationRules('unique:timezones,php'),
            Boolean::make('Is daylight saving')->required()->default(1),
            Number::make('Dst')->rules('numeric', 'min:-99.99', 'max:99.99')->min(-99.99)->max(99.99)->step(0.01)->nullable(),
            Number::make('Standard')->min(-99.99)->max(99.99)->step(0.01)->nullable(),

            /* @todo HasMany::searchable does not exist  */
            /*nova('zip') ? HasMany::make('Zips', 'zips', nova('zip'))->searchable() : null,*/

            new Panel('Data Fields', $this->dataFields()),
        ]);
    }

    public function dataFields(): array
    {
        return array_merge(
            parent::dataFields(),
        );
    }
}
