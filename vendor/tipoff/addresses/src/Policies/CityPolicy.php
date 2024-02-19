<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Addresses\Models\City;
use Tipoff\Support\Contracts\Models\UserInterface;

class CityPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view cities');
    }

    public function view(UserInterface $user, City $city): bool
    {
        return $user->hasPermissionTo('view cities');
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create cities');
    }

    public function update(UserInterface $user, City $city): bool
    {
        return $user->hasPermissionTo('update cities');
    }

    public function delete(UserInterface $user, City $city): bool
    {
        return false;
    }

    public function restore(UserInterface $user, City $city): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, City $city): bool
    {
        return false;
    }
}
