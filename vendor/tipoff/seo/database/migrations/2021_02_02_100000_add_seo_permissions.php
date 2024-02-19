<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddSeoPermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view companies' => ['Owner', 'Executive', 'Staff'],
            'create companies' => ['Owner', 'Executive'],
            'update companies' => ['Owner', 'Executive'],
            'view domains' => ['Owner', 'Executive', 'Staff'],
            'create domains' => ['Owner', 'Executive'],
            'update domains' => ['Owner', 'Executive'],
            'view webpages' => ['Owner', 'Executive', 'Staff'],
            'create webpages' => ['Owner', 'Executive'],
            'update webpages' => ['Owner', 'Executive', 'Staff'],
            'view places' => ['Owner', 'Executive', 'Staff'],
            'create places' => ['Owner', 'Executive'],
            'update places' => ['Owner', 'Executive'],
            'view keywords' => ['Owner', 'Executive', 'Staff'],
            'create keywords' => ['Owner', 'Executive'],
            'update keywords' => ['Owner', 'Executive'],
            'view rankings' => ['Owner', 'Executive', 'Staff'],
            'create rankings' => ['Owner', 'Executive'],
            'update rankings' => ['Owner', 'Executive'],
            'view search volumes' => ['Owner', 'Executive', 'Staff'],
            'create search volumes' => ['Owner', 'Executive'],
            'update search volumes' => ['Owner', 'Executive'],
            'view business categories' => ['Owner', 'Executive', 'Staff'],
            'create business categories' => ['Owner', 'Executive'],
            'update business categories' => ['Owner', 'Executive'],
        ];

        $this->createPermissions($permissions);
    }
}
