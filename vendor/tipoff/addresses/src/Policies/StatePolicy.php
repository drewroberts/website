<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Addresses\Models\State;
use Tipoff\Support\Contracts\Models\UserInterface;

class StatePolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view states');
    }

    public function view(UserInterface $user, State $state): bool
    {
        return $user->hasPermissionTo('view states');
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create states');
    }

    public function update(UserInterface $user, State $state): bool
    {
        return $user->hasPermissionTo('update states');
    }

    public function delete(UserInterface $user, State $state): bool
    {
        return false;
    }

    public function restore(UserInterface $user, State $state): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, State $state): bool
    {
        return false;
    }
}
