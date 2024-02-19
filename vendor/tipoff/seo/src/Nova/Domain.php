<?php

declare(strict_types=1);

namespace Tipoff\Seo\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;

class Domain extends BaseResource
{
    public static $model = \Tipoff\Seo\Models\Domain::class;

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
            Text::make('Domain Name', 'formatted_title'),
            Text::make('Name')->sortable(),
            Text::make('TLD')->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Domain Name', 'formatted_title')
                ->onlyOnIndex(),
            Text::make('Name')
                ->required()
                ->creationRules("unique:domains,name,NULL,id,tld,$request->tld")
                ->updateRules("unique:domains,name,{{resourceId}},id,tld,$request->tld"),
            Text::make('TLD')
                ->required()
                ->creationRules("unique:domains,tld,NULL,id,name,$request->name")
                ->updateRules("unique:domains,tld,{{resourceId}},id,name,$request->name")
                ->help('Top-level domain'),
            Boolean::make('Https')->required()->default(true),
            Text::make('Subdomain')->nullable(),

            nova('company') ? BelongsTo::make('Company', 'company', nova('company'))->nullable() : null,

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
