<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Addresses\Models\CountryCallingcode;
use Tipoff\Support\Contracts\Models\UserInterface;

class CountryCallingcodePolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view country callingcodes');
    }

    public function view(UserInterface $user, CountryCallingcode $country_callingcode): bool
    {
        return $user->hasPermissionTo('view country callingcodes');
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create country callingcodes');
    }

    public function update(UserInterface $user, CountryCallingcode $country_callingcode): bool
    {
        return $user->hasPermissionTo('update country callingcodes');
    }

    public function delete(UserInterface $user, CountryCallingcode $country_callingcode): bool
    {
        return false;
    }

    public function restore(UserInterface $user, CountryCallingcode $country_callingcode): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, CountryCallingcode $country_callingcode): bool
    {
        return false;
    }
}
