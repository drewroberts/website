<?php

namespace DrewRoberts\Blog\Nova;

use DrewRoberts\Blog\Nova\Fields\TextCopy;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Enums\LayoutType;
use Tipoff\Support\Nova\BaseResource;

class Page extends BaseResource
{
    public static $model = \DrewRoberts\Blog\Models\Page::class;

    public static $title = 'title';

    public static $search = [
        'id',
        'title',
    ];

    public static $group = 'Website Content';

    public function actions(Request $request)
    {
        return [
            (new Actions\PreviewPage())
                ->onlyOnTableRow()
                ->withoutConfirmation(),
        ];
    }

    public static function relatableLayouts(NovaRequest $request, $query)
    {
        return $query->where('layout_type', LayoutType::PAGE);
    }

    public function fieldsForIndex(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug')->sortable(),
            Text::make('Title')->sortable(),
            nova('page') ? BelongsTo::make('Parent', 'parent', nova('page'))->sortable() : null,
            nova('user') ? BelongsTo::make('Author', 'author', nova('user'))->sortable() : null,
            DateTime::make('Published', 'published_at')->format('YYYY-MM-DD')->sortable(),
        ];
    }

    public function fields(Request $request)
    {
        return [
            Text::make('Title')->required(),
            Slug::make('Slug')->from('Title'),
            TextCopy::make('Link',  function () {
                return config('app.url') ."/". config('tipoff.web.uri_prefix') . $this->path;
            })->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            nova('layout') ? BelongsTo::make('Layout', 'layout', nova('layout'))->nullable() : null,
            DateTime::make('Published', 'published_at'),
            nova('page') ? BelongsTo::make('Parent', 'parent', nova('page'))->nullable() : null,
            Markdown::make('Content')->help(
                '<a href="https://www.markdownguide.org">MarkdownGuide.org</a>'
            )->stacked(),

            new Panel('Info Fields', $this->infoFields()),
            new Panel('Data Fields', $this->dataFields()),
        ];
    }

    protected function infoFields()
    {
        return [
            nova('user') ? BelongsTo::make('Author', 'author', nova('user'))->nullable() : null,
            Textarea::make('Description'),
            Textarea::make('Open Graph Description', 'ogdescription')->nullable(),
            nova('image') ? BelongsTo::make('Image', 'image', nova('image'))->nullable()->showCreateRelationButton() : null,
            nova('image') ? BelongsTo::make('OG Image', 'ogimage', nova('image'))->nullable()->showCreateRelationButton() : null,
            nova('video') ? BelongsTo::make('Video', 'video', nova('video'))->nullable()->showCreateRelationButton() : null,
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
