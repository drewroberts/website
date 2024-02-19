<?php

declare(strict_types=1);

namespace Tipoff\GoogleApi\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;

class GmbAccount extends BaseResource
{
    public static $model = \Tipoff\GoogleApi\Models\GmbAccount::class;

    public static $orderBy = ['id' => 'asc'];

    public static $title = 'account_number';

    public static $search = [
        'account_number',
    ];

    public static $group = 'Z - Admin';

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            Text::make('Account_number')->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Account_number')->required(),

            new Panel('Data Fields', $this->dataFields()),
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
