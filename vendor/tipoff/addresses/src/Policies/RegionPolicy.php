<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Addresses\Models\Region;
use Tipoff\Support\Contracts\Models\UserInterface;

class RegionPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view regions');
    }

    public function view(UserInterface $user, Region $region): bool
    {
        return $user->hasPermissionTo('view regions');
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create regions');
    }

    public function update(UserInterface $user, Region $region): bool
    {
        return $user->hasPermissionTo('update regions');
    }

    public function delete(UserInterface $user, Region $region): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Region $region): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Region $region): bool
    {
        return false;
    }
}
