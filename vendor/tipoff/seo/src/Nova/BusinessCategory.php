<?php

declare(strict_types=1);

namespace Tipoff\Seo\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;

class BusinessCategory extends BaseResource
{
    public static $model = \Tipoff\Seo\Models\BusinessCategory::class;

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
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Name')
                ->required()
                ->creationRules('unique:business_categories,name')
                ->updateRules('unique:business_categories,name,{{resourceId}}'),
            Text::make('Slug')
                ->required()
                ->creationRules('unique:business_categories,slug')
                ->updateRules('unique:business_categories,slug,{{resourceId}}'),

            new Panel('Data Fields', $this->dataFields()),
        ]);
    }

    public function dataFields(): array
    {
        return array_merge(
            parent::dataFields(),
            $this->creatorDataFields()
        );
    }
}
