<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddBlogPermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
                 'view pages' => ['Owner', 'Staff'],
                 'create pages' => ['Owner'],
                 'update pages' => ['Owner'],
                 'view posts' => ['Owner', 'Staff'],
                 'create posts' => ['Owner'],
                 'update posts' => ['Owner'],
                 'view series' => ['Owner', 'Staff'],
                 'create series' => ['Owner'],
                 'update series' => ['Owner'],
                 'view topics' => ['Owner', 'Staff'],
                 'create topics' => ['Owner'],
                 'update topics' => ['Owner'],
        ];

        $this->createPermissions($permissions);
    }
}


