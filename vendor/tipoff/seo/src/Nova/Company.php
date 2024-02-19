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

class Company extends BaseResource
{
    public static $model = \Tipoff\Seo\Models\Company::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'name',
    ];

    public static $group = 'SEO';

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            Text::make('Phone', 'phone.id', function () {
                return $this->phone->full_number ?? null;
            }),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Name')->required(),
            Text::make('Slug')
                ->required()
                ->creationRules('unique:companies,slug')->sortable()
                ->updateRules('unique:companies,slug,{{resourceId}}'),

            nova('domestic_address') ? BelongsTo::make('Domestic Address', 'domestic_address', nova('domestic_address'))->sortable()->nullable() : null,

            nova('phone') ? BelongsTo::make('Phone', 'phone', nova('phone'))->sortable()->nullable() : null,

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
