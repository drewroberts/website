<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddAddressesPermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view addresses' => ['Owner', 'Executive', 'Staff'],
            'create addresses' => ['Owner', 'Executive'],
            'update addresses' => ['Owner', 'Executive'],
            'view cities' => ['Owner', 'Executive', 'Staff'],
            'create cities' => ['Owner', 'Executive'],
            'update cities' => ['Owner', 'Executive'],
            'view countries' => ['Owner', 'Executive', 'Staff'],
            'create countries' => ['Owner', 'Executive'],
            'update countries' => ['Owner', 'Executive'],
            'view country callingcodes' => ['Owner', 'Executive', 'Staff'],
            'create country callingcodes' => ['Owner', 'Executive'],
            'update country callingcodes' => ['Owner', 'Executive'],
            'view domestic addresses' => ['Owner', 'Executive', 'Staff'],
            'create domestic addresses' => ['Owner', 'Executive'],
            'update domestic addresses' => ['Owner', 'Executive'],
            'view phone areas' => ['Owner', 'Executive', 'Staff'],
            'create phone areas' => ['Owner', 'Executive'],
            'update phone areas' => ['Owner', 'Executive'],
            'view phones' => ['Owner', 'Executive', 'Staff'],
            'create phones' => ['Owner', 'Executive'],
            'update phones' => ['Owner', 'Executive'],
            'view regions' => ['Owner', 'Executive', 'Staff'],
            'create regions' => ['Owner', 'Executive'],
            'update regions' => ['Owner', 'Executive'],
            'view states' => ['Owner', 'Executive', 'Staff'],
            'create states' => ['Owner', 'Executive'],
            'update states' => ['Owner', 'Executive'],
            'view timezones' => ['Owner', 'Executive', 'Staff'],
            'create timezones' => ['Owner', 'Executive'],
            'update timezones' => ['Owner', 'Executive'],
            'view zip codes' => ['Owner', 'Executive', 'Staff'],
            'create zip codes' => ['Owner', 'Executive'],
            'update zip codes' => ['Owner', 'Executive'],
        ];

        $this->createPermissions($permissions);
    }
}
