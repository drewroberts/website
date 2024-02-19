<?php

namespace DrewRoberts\Blog\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Enums\LayoutType;
use Tipoff\Support\Nova\BaseResource;
use Tipoff\Support\Nova\Filters\EnumFilter;

class Layout extends BaseResource
{
    public static $model = \DrewRoberts\Blog\Models\Layout::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'name',
    ];

    public static $group = 'Website Layout';
    
    /** @psalm-suppress UndefinedClass */
    protected array $filterClassList = [

    ];

    public function filters(Request $request)
    {
        return array_merge(parent::filters($request), [
            EnumFilter::make('layout_type', LayoutType::class),
        ]);
    }

    public function fieldsForIndex(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            \Tipoff\Support\Nova\Fields\Enum::make('Layout Type')
                ->attach(LayoutType::class)
                ->sortable(),
        ];
    }

    public function fields(Request $request)
    {
        return [
            Text::make('Name')->required(),
            \Tipoff\Support\Nova\Fields\Enum::make('Layout Type')
                ->attach(LayoutType::class)
                ->required(),
            Text::make('View')->required(),
            Text::make('Note')->nullable(),
            nova('image') ? BelongsTo::make('Image', 'image', nova('image'))->nullable()->showCreateRelationButton() : null,

            new Panel('Data Fields', $this->dataFields()),
        ];
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
