<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Tipoff\Support\Nova\BaseResource;

class Zip extends BaseResource
{
    public static $model = \Tipoff\Addresses\Models\Zip::class;

    public static $title = 'code';

    public static $search = [
        'code',
        'states.title',
    ];

    public static $group = 'Resources';

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->select('zips.*');
        $query->addSelect('states.title');
        $query->leftJoin('states', 'zips.state_id', '=', 'states.id');

        return $query;
    }

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            Text::make('Code')->sortable(),
            Text::make('State', 'state_id', function () {
                return $this->state->title;
            })->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Number::make('Code')
                ->rules('numeric', 'digits_between:1,5')
                ->required()
                ->creationRules('unique:zips,code')
                ->updateRules('unique:zips,code,{{resourceId}}'),
            nova('state') ? BelongsTo::make('State', 'state', nova('state'))->searchable() : null,
            nova('region') ? BelongsTo::make('Region', 'region', nova('region'))->searchable() : null,
            nova('timezone') ? BelongsTo::make('Timezone', 'timezone', nova('timezone'))->searchable() : null,
            Number::make('Latitude')->step(0.000001)->nullable(),
            Number::make('Longitude')->step(0.000001)->nullable(),
            Boolean::make('Military')->default(0),
            Boolean::make('ZTCA')->default(1),

            nova('zip') ? BelongsTo::make('Parent Zip Code', 'parent', nova('zip'))->searchable()->nullable() : null,

            nova('city') ? BelongsToMany::make('Cities', 'cities', nova('city'))
                ->fields(function () {
                    return [
                        Boolean::make('Primary')->required()->default(0),
                    ];
                })->searchable() : null,
            nova('domestic_address') ? HasMany::make('Domestic Address', 'domesticAddresses', nova('domestic_address')) : null,
        ]);
    }

    protected function dataFields(): array
    {
        return array_merge(
            $this->creatorDataFields(),
            $this->updaterDataFields(),
        );
    }
}
