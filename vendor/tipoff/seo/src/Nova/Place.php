<?php

declare(strict_types=1);

namespace Tipoff\Seo\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;

class Place extends BaseResource
{
    public static $model = \Tipoff\Seo\Models\Place::class;

    public static $title = 'name';

    public static $search = [
        'id',
    ];

    public static $group = 'SEO';

    public static $displayInNavigation = false; //don't show resource in navigation

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Place location')->required()->creationRules('unique:places,place_location'),
            Text::make('Name')->nullable(),

            nova('webpage') ? BelongsTo::make('Webpage', 'webpage', nova('webpage'))->nullable() : null,
            nova('company') ? BelongsTo::make('Company', 'company', nova('company'))->nullable() : null,
            MorphMany::make('Results'),

            new Panel('Data Fields', $this->dataFields()),
        ]);
    }

    public function dataFields(): array
    {
        return array_merge(
            parent::dataFields(),
            $this->creatorDataFields(),
            $this->updaterDataFields(),
        );
    }
}
