<?php

declare(strict_types=1);

namespace Tipoff\Authorization\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Authorization\Models\User;
use Tipoff\Support\Contracts\Models\UserInterface;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view users') ? true : false;
    }

    public function view(UserInterface $user, User $model): bool
    {
        return $user->hasPermissionTo('view users') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create users') ? true : false;
    }

    public function update(UserInterface $user, User $model): bool
    {
        return $user->hasPermissionTo('update users') ? true : false;
    }

    public function delete(UserInterface $user, User $model): bool
    {
        return false;
    }

    public function restore(UserInterface $user, User $model): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, User $model): bool
    {
        return false;
    }
}
