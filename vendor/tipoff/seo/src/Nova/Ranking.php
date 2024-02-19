<?php

declare(strict_types=1);

namespace Tipoff\Seo\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;

class Ranking extends BaseResource
{
    public static $model = \Tipoff\Seo\Models\Ranking::class;

    public static $title = 'engine';

    public static $search = [
        'id',
    ];

    public static $group = 'SEO';

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            Text::make('Engine')->sortable(),
            Date::make('Date')->sortable(),
            BelongsTo::make('Keyword'),
            BelongsTo::make('Search Locale', 'searchLocale'),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Engine')->required()->sortable(),
            Text::make('Provider')->required()->sortable(),
            Date::make('Date')->required()->sortable(),

            nova('keyword') ? BelongsTo::make('Keyword', 'keyword', nova('keyword'))->sortable() : null,
            nova('search_locale') ? BelongsTo::make('Search Locale', 'searchLocale', nova('search_locale'))->sortable() : null,

            nova('result') ? HasMany::make('Results', 'results', nova('result')) : null,
            new Panel('Data Fields', $this->dataFields()),
        ]);
    }

    public function dataFields(): array
    {
        return array_merge(
            parent::dataFields(),
            $this->creatorDataFields(),
            $this->updaterDataFields()
        );
    }
}
