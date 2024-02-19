<?php

declare(strict_types=1);

namespace Tipoff\Seo\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;

class PlaceHours extends BaseResource
{
    public static $model = \Tipoff\Seo\Models\PlaceHours::class;

    public static $title;

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
            Text::make('Monday open')->nullable(),
            Text::make('Monday close')->nullable(),
            Text::make('Tuesday open')->nullable(),
            Text::make('Tuesday close')->nullable(),
            Text::make('Wednesday open')->nullable(),
            Text::make('Wednesday close')->nullable(),
            Text::make('Thursday open')->nullable(),
            Text::make('Thursday close')->nullable(),
            Text::make('Friday open')->nullable(),
            Text::make('Friday close')->nullable(),
            Text::make('Saturday open')->nullable(),
            Text::make('Saturday close')->nullable(),
            Text::make('Sunday open')->nullable(),
            Text::make('Sunday close')->nullable(),

            nova('place') ? BelongsTo::make('Place', 'place', nova('place'))->sortable() : null,

            new Panel('Data Fields', $this->dataFields()),
        ]);
    }

    protected function dataFields(): array
    {
        return array_merge(
            parent::dataFields(),
            $this->creatorDataFields(),
        );
    }
}
