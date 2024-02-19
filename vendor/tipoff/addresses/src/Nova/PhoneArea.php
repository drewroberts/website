<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Tipoff\Support\Nova\BaseResource;

class PhoneArea extends BaseResource
{
    public static $model = \Tipoff\Addresses\Models\PhoneArea::class;

    public static $title = 'code';

    public static $search = [
        'code', 'states.title',
    ];

    public static $group = 'Resources';

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->select('phone_areas.*');
        $query->addSelect('states.title');
        $query->leftJoin('states', 'phone_areas.state_id', '=', 'states.id');

        return $query;
    }

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            Text::make('Code')->sortable(),
            Text::make('State', 'state_id', function () {
                return $this->state->title;
            })->sortable(),
            Text::make('Note', 'note')->displayUsing(function ($id) {
                $part = strip_tags(substr($id, 0, 100));

                return $part . " ...";
            }),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Number::make('Code')->rules('required', 'integer', 'digits:5'),
            TextArea::make('Note')->nullable(),
            nova('state') ? BelongsTo::make('State', 'state', nova('state'))->searchable() : null,
        ]);
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
