<?php

declare(strict_types=1);

namespace Tipoff\Seo\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Seo\Enum\KeywordType;
use Tipoff\Support\Nova\BaseResource;

class Keyword extends BaseResource
{
    public static $model = \Tipoff\Seo\Models\Keyword::class;

    public static $title = 'phrase';

    public static $search = [
        'id',
        'phrase',
    ];

    public static $group = 'SEO';

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            Text::make('Phrase')->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Phrase')
                ->rules([
                    'required',
                    function ($attribute, $value, $fail) {
                        if (strtolower($value) !== $value) {
                            return $fail('The '.$attribute.' field must be lowercase.');
                        }
                    },
                ])
                ->creationRules('unique:keywords,phrase')
                ->updateRules('unique:keywords,phrase,{{resourceId}}')
                ->sortable(),
            Select::make('Type')->options([
                KeywordType::BRANDED => 'Branded',
                KeywordType::GENERIC => 'Generic',
                KeywordType::LOCAL => 'Local',
            ])
                ->rules(['required'])
                ->sortable(),
            DateTime::make('Tracking Requested At')->nullable(),
            DateTime::make('Tracking Stopped At')->nullable(),

            nova('keyword') ? BelongsTo::make('Parent', 'parent', nova('keyword'))->nullable() : null,

            nova('search_locale') ? BelongsToMany::make('Search Locale', 'searchLocales', nova('search_locale')) : null,

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
