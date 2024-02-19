<?php

declare(strict_types=1);

namespace Tipoff\Authorization\Permissions;

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Arr;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class BasePermissionsMigration extends Migration
{
    public function createPermissions($permissions)
    {
        $permissions = $this->preparePermissions($permissions);

        // Add all permissions in bulk
        Permission::query()->insertOrIgnore(
            $this->buildPermissionRecords($permissions)
        );

        $rolePermissions = $this->buildRolePermissions($permissions);
        foreach ($rolePermissions as $roleName => $permissionNames) {
            /** @var Role $role */
            if ($role = Role::findByName($roleName)) {
                $role->givePermissionTo($permissionNames);
            }
        }

        /** @psalm-suppress UndefinedMethod */
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function preparePermissions(array $permissions): array
    {
        /*
         * allow for permissions to be:
         * 1. permission => [...roles],
         * 2. permission => [],  (empty array)
         * 3. permission string without value (for backward compat)
         */
        if (! Arr::isAssoc($permissions)) {
            /** @psalm-suppress UnusedClosureParam */
            $permissions = array_map(function ($value) {
                return [];
            }, array_flip($permissions));
        }

        return $permissions;
    }

    public function buildPermissionRecords(array $permissions): array
    {
        $guardName = Guard::getDefaultName(Permission::class);
        $now = Carbon::now()->format('Y-m-d H:i:s');

        return collect(array_keys($permissions))
            ->map(function (string $permission) use ($guardName, $now) {
                return [
                    'name' => $permission,
                    'guard_name' => $guardName,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            })->toArray();
    }

    public function buildRolePermissions(array $permissions): array
    {
        $rolePermissions = [];
        foreach ($permissions as $permissionName => $roles) {
            $roles = array_unique(array_merge(['Admin'], $roles));
            foreach ($roles as $roleName) {
                $rolePermissions[$roleName][] = $permissionName;
            }
        }

        return $rolePermissions;
    }
}
