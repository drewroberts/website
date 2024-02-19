<?php

namespace DrewRoberts\Blog\Nova;

use DrewRoberts\Blog\Nova\Fields\TextCopy;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Enums\LayoutType;
use Tipoff\Support\Nova\BaseResource;

class Series extends BaseResource
{
    public static $model = \DrewRoberts\Blog\Models\Series::class;

    public static $title = 'title';

    public static $search = [
        'id',
        'title',
    ];

    public static $group = 'Website Blog';

    public function actions(Request $request)
    {
        return [
            (new Actions\PreviewSeries())
                ->onlyOnTableRow()
                ->withoutConfirmation(),
        ];
    }

    public static function relatableLayouts(NovaRequest $request, $query)
    {
        return $query->where('layout_type', LayoutType::SERIES);
    }

    public function fieldsForIndex(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug')->sortable(),
            Text::make('Title')->sortable(),
            nova('topic') ? BelongsTo::make('Topic', 'topic', nova('topic'))->sortable() : null,
            // @todo add count for Posts
        ];
    }

    public function fields(Request $request)
    {
        return [
            Text::make('Title')->required(),
            Slug::make('Slug')->from('Title'),
            TextCopy::make('Link',  function () {
                return config('app.url') . config('tipoff.web.uri_prefix') . $this->path;
            })->hideWhenCreating()->hideWhenUpdating()->asHtml(),
            nova('topic') ? BelongsTo::make('Topic', 'topic', nova('topic')) : null,
            nova('layout') ? BelongsTo::make('Layout', 'layout', nova('layout'))->nullable() : null,
            Textarea::make('Note')->nullable(),
            new Panel('Content Fields', $this->contentFields()),

            nova('post') ? HasMany::make('Posts', 'posts', nova('post')) : null,

            new Panel('Data Fields', $this->dataFields()),
        ];
    }

    protected function contentFields()
    {
        return [
            Markdown::make('Content')->help(
                '<a href="https://www.markdownguide.org">MarkdownGuide.org</a>'
            )->stacked(),
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
