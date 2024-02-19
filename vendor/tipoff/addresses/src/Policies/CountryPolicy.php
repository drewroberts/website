<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Addresses\Models\Country;
use Tipoff\Support\Contracts\Models\UserInterface;

class CountryPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view countries');
    }

    public function view(UserInterface $user, Country $country): bool
    {
        return $user->hasPermissionTo('view countries');
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create countries');
    }

    public function update(UserInterface $user, Country $country): bool
    {
        return $user->hasPermissionTo('update countries');
    }

    public function delete(UserInterface $user, Country $country): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Country $country): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Country $country): bool
    {
        return false;
    }
}
