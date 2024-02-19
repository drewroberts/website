<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Tipoff\Support\Nova\BaseResource;

class Country extends BaseResource
{
    public static $model = \Tipoff\Addresses\Models\Country::class;

    public static $title = 'abbreviation';

    public static $search = [
        'id',
        'title',
        'abbreviation',
    ];

    public static $group = 'Resources';

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            Text::make('Title')->sortable(),
            Text::make('Abbreviation')->sortable(),
            Text::make('Capital')->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Title')->required()
                ->creationRules('unique:countries,title')
                ->updateRules('unique:countries,title,{{resourceId}}'),
            Text::make('Official')->required()
                ->creationRules('unique:countries,official')
                ->updateRules('unique:countries,official,{{resourceId}}'),
            Text::make('Abbreviation')->required()
                ->rules('max:3')
                ->creationRules('unique:countries,abbreviation')
                ->updateRules('unique:countries,abbreviation,{{resourceId}}'),
            Slug::make('Slug')->from('Abbreviation')->required()
                ->creationRules('unique:countries,slug')
                ->updateRules('unique:countries,slug,{{resourceId}}'),
            Text::make('Capital')->nullable(),
            Number::make('Area')->nullable(),
            Boolean::make('Independent')->default(1),
            Boolean::make('UN Member')->default(1),
            Boolean::make('Landlocked')->default(0),

            nova('state') ? HasMany::make('States', 'states', nova('state')) : null,
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
