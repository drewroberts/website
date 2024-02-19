<?php

declare(strict_types=1);

namespace Tipoff\Seo\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Seo\Enum\ResultType;
use Tipoff\Support\Nova\BaseResource;

class Result extends BaseResource
{
    public static $model = \Tipoff\Seo\Models\Result::class;

    public static $with = [
        'resultable',
    ];

    public static $title = 'position';

    public static $search = [
        'id', 'type',
    ];

    public static $defaultSort = [
        'type' => 'asc',
        'position' => 'asc',
    ];

    public static $group = 'SEO';

    public static $displayInNavigation = false; //don't show resource in navigation

    /**
     * Build an "index" query for the given resource to sort on multiple columns.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (static::$defaultSort && empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            foreach (static::$defaultSort as $field => $order) {
                $query->orderBy($field, $order);
            }
        }

        return $query;
    }

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            Text::make('Type')->sortable(),
            Text::make('Position')->sortable(),
            MorphTo::make('Resultable'),
            Text::make('Domain', 'resultable.id', function () {
                if (isset($this->resultable->domain)) {
                    return $this->resultable->domain->formatted_title;
                } else {
                    return null;
                }
            }),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Select::make('Type')->options([
                ResultType::ORGANIC_LISTING => 'Organic Listings',
                ResultType::LOCAL_LISTING => 'Local Listings',
                ResultType::FEATURED_SNIPPET => 'Featured Snippet',
                ResultType::INLINE_VIDEO_LISTINGS => 'Inline Video Listings',
                ResultType::ADS => 'Product',
            ])->required(),
            Number::make('Position')->required()->min(0)->max(255),

            nova('ranking') ? BelongsTo::make('Ranking', 'ranking', nova('ranking'))->sortable() : null,
            MorphTo::make('Resultable')->types([
                nova('place'),
                nova('webpage'),
            ]),
            Text::make('Domain', 'resultable.id', function () {
                if (isset($this->resultable->domain)) {
                    return $this->resultable->domain->formatted_title;
                } else {
                    return null;
                }
            })->onlyOnDetail(),


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
