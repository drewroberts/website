<?php

declare(strict_types=1);

namespace Tipoff\Authorization\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;
use Vyuldashev\NovaPermission\PermissionBooleanGroup;
use Vyuldashev\NovaPermission\RoleBooleanGroup;

class User extends BaseResource
{
    public static $model = \Tipoff\Authorization\Models\User::class;

    public static $orderBy = ['id' => 'asc'];

    public static $title = 'full_name';

    public function subtitle()
    {
        return "ID: {$this->id} - {$this->email}";
    }

    public static $search = [
        'id',
        'first_name',
        'last_name',
    ];

    public static $group = 'Access';

    public function fieldsForIndex(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Gravatar::make()->maxWidth(50),
            Text::make('First Name', 'first_name')->sortable(),
            Text::make('Last Name', 'last_name')->sortable(),
            Text::make('Email'),
        ];
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('First Name', 'first_name')
                ->rules(['required', 'max:255']),

            Text::make('Last Name', 'last_name')
                ->rules(['required', 'max:255']),

            Gravatar::make()->maxWidth(50),

            Text::make('Bio'),
            Text::make('Title'),

            HasMany::make('Email Addresses', 'emailAddresses', nova('email_address')),

            nova('location') ? BelongsToMany::make('Locations', 'locations', nova('location')) : null,

            nova('customer') ? HasMany::make('Customers', 'customers', nova('customer')) : null,
            nova('participant') ? HasMany::make('Participants', 'participants', nova('participant')) : null,

            nova('location') ? HasMany::make('Managed Locations', 'managedLocations', nova('location')) : null,
            nova('post') ? HasMany::make('Posts', 'posts', nova('post')) : null,
            nova('voucher') ? HasMany::make('Vouchers Created', 'vouchersCreated', nova('voucher')) : null,
            nova('blocks') ? HasMany::make('Blocks', 'blocks', nova('blocks')) : null,

            new Panel('Permissions', $this->permissionFields()),

            new Panel('Data Fields', $this->dataFields()),
        ]);
    }

    protected function permissionFields()
    {
        return [
            RoleBooleanGroup::make('Roles')->canSee(function ($request) {
                return $request->user()->can('assign roles');
            }),
            PermissionBooleanGroup::make('Permissions')->canSee(function ($request) {
                return $request->user()->can('assign permissions');
            }),
        ];
    }

    protected function dataFields(): array
    {
        return array_merge(parent::dataFields(), [
            DateTime::make('Created At')->exceptOnForms(),
            DateTime::make('Updated At')->exceptOnForms(),
        ]);
    }

    public function authorizedToForceDelete(Request $request)
    {
        return false;
    }
}
