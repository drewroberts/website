<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Addresses\Models\Phone;
use Tipoff\Support\Contracts\Models\UserInterface;

class PhonePolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view phones');
    }

    public function view(UserInterface $user, Phone $phone): bool
    {
        return $user->hasPermissionTo('view phones');
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create phones');
    }

    public function update(UserInterface $user, Phone $phone): bool
    {
        return $user->hasPermissionTo('update phones');
    }

    public function delete(UserInterface $user, Phone $phone): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Phone $phone): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Phone $phone): bool
    {
        return false;
    }
}
