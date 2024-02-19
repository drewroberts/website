<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Tipoff\Support\Nova\BaseResource;

class CountryCallingcode extends BaseResource
{
    public static $model = \Tipoff\Addresses\Models\CountryCallingcode::class;

    public static $title = 'title';

    public static $search = [
        'code', 'countries.title',
    ];

    public static $with = [
        'country',
    ];

    public function title()
    {
        return $this->country->abbreviation;
    }

    public static $group = 'Resources';

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->select('country_callingcodes.*');
        $query->addSelect('countries.title');
        $query->leftJoin('countries', 'country_callingcodes.country_id', '=', 'countries.id');

        return $query;
    }

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            Text::make('Country', 'country_id', function () {
                return $this->country->title;
            })->sortable(),
            Text::make('Code')->sortable(),
            Text::make('Display')->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            nova('country') ? BelongsTo::make('Country', 'country', nova('country'))->searchable() : null,
            Text::make('Code')
                ->required()
                ->rules('max:6')
                ->creationRules("unique:country_callingcodes,code,NULL,id,country_id,$request->country")
                ->updateRules("unique:country_callingcodes,code,{{resourceId}},id,country_id,$request->country"),
            Text::make('Display')->nullable(),
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
