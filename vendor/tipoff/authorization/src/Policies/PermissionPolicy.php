<?php

declare(strict_types=1);

namespace Tipoff\Authorization\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Permission;
use Tipoff\Support\Contracts\Models\UserInterface;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view permissions') ? true : false;
    }

    public function view(UserInterface $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('view permissions') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create permissions') ? true : false;
    }

    public function update(UserInterface $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('update permissions') ? true : false;
    }

    public function delete(UserInterface $user, Permission $permission): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Permission $permission): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Permission $permission): bool
    {
        return false;
    }
}
