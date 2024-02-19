<?php

declare(strict_types=1);

namespace Tipoff\Authorization\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;
use Tipoff\Support\Contracts\Models\UserInterface;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view roles') ? true : false;
    }

    public function view(UserInterface $user, Role $role): bool
    {
        return $user->hasPermissionTo('view roles') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create roles') ? true : false;
    }

    public function update(UserInterface $user, Role $role): bool
    {
        return $user->hasPermissionTo('update roles') ? true : false;
    }

    public function delete(UserInterface $user, Role $role): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Role $role): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Role $role): bool
    {
        return false;
    }
}
