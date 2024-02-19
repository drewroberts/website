<?php

declare(strict_types=1);

namespace Tipoff\GoogleApi\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\GoogleApi\Models\Key;
use Tipoff\Support\Contracts\Models\UserInterface;

class KeyPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view keys') ? true : false;
    }

    public function view(UserInterface $user, Key $key): bool
    {
        return $user->hasPermissionTo('view keys') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return false;
    }

    public function update(UserInterface $user, Key $key): bool
    {
        return false;
    }

    public function delete(UserInterface $user, Key $key): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Key $key): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Key $key): bool
    {
        return false;
    }
}
