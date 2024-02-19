<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Addresses\Models\DomesticAddress;
use Tipoff\Support\Contracts\Models\UserInterface;

class DomesticAddressPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view addresses');
    }

    public function view(UserInterface $user, DomesticAddress $address): bool
    {
        return $user->hasPermissionTo('view addresses');
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create addresses');
    }

    public function update(UserInterface $user, DomesticAddress $address): bool
    {
        return $user->hasPermissionTo('update addresses');
    }

    public function delete(UserInterface $user, DomesticAddress $address): bool
    {
        return false;
    }

    public function restore(UserInterface $user, DomesticAddress $address): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, DomesticAddress $address): bool
    {
        return false;
    }
}
