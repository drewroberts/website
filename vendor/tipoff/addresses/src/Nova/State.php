<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasManyThrough;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Tipoff\Support\Nova\BaseResource;

class State extends BaseResource
{
    public static $model = \Tipoff\Addresses\Models\State::class;

    public static $title = 'abbreviation';

    public static $search = [
        'id',
        'title',
        'abbreviation',
        'countries.title',
    ];

    public static $group = 'Resources';

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->select('states.*');
        $query->addSelect('countries.title');
        $query->leftJoin('countries', 'states.country_id', '=', 'countries.id');

        return $query;
    }

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            Text::make('Slug')->sortable(),
            Text::make('Title')->sortable(),
            Text::make('Abbreviation')->sortable(),
            Text::make('Country', 'country_id', function () {
                return $this->country->title;
            })->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Slug')->required()
                ->creationRules('unique:states,slug')
                ->updateRules('unique:states,slug,{{resourceId}}'),
            Text::make('Title')->required()
                ->creationRules('unique:states,title')
                ->updateRules('unique:states,title,{{resourceId}}'),
            Text::make('Abbreviation')->rules('required', 'max:2')
                ->creationRules('unique:states,abbreviation')
                ->updateRules('unique:states,abbreviation,{{resourceId}}'),
            Text::make('Capital')->nullable(),
            nova('country') ? BelongsTo::make('Country', 'country', nova('country'))->searchable() : null,
            /* @todo HasMany::searchable does not exist  */
            /*nova('zip') ? HasMany::make('Zips', 'zips', nova('zip'))->searchable() : null,*/
            nova('city') ? HasManyThrough::make('Cities', 'cities', nova('city')) : null,
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
