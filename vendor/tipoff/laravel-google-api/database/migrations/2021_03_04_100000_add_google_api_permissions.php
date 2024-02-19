<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddGoogleApiPermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view gmb accounts' => ['Owner','Executive'],
            'create gmb accounts' => [],
            'update gmb accounts' => [],
            'view keys' => [],
        ];

        $this->createPermissions($permissions);
    }
}
