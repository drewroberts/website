<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Addresses\Models\PhoneArea;
use Tipoff\Support\Contracts\Models\UserInterface;

class PhoneAreaPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view phone areas');
    }

    public function view(UserInterface $user, PhoneArea $phone_area): bool
    {
        return $user->hasPermissionTo('view phone areas');
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create phone areas');
    }

    public function update(UserInterface $user, PhoneArea $phone_area): bool
    {
        return $user->hasPermissionTo('update phone areas');
    }

    public function delete(UserInterface $user, PhoneArea $phone_area): bool
    {
        return false;
    }

    public function restore(UserInterface $user, PhoneArea $phone_area): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, PhoneArea $phone_area): bool
    {
        return false;
    }
}
