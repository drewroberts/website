<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddAuthPermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'access admin' => ['Owner','Executive','Staff'],
            'view users' => ['Owner','Executive','Staff'],
            'create users' => ['Owner','Executive','Staff'],
            'update users' => ['Owner','Executive'],
            'assign roles' => ['Owner','Executive'],
            'view roles' => ['Owner','Executive'],
            'create roles' => [],
            'update roles' => [],
            'assign permissions' => [],
            'view permissions' => ['Owner','Executive'],
            'create permissions' => [],
            'update permissions' => [],
        ];

        $this->createPermissions($permissions);
    }
}
