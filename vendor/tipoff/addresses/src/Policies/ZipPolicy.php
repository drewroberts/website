<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Addresses\Models\Zip;
use Tipoff\Support\Contracts\Models\UserInterface;

class ZipPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view zip codes');
    }

    public function view(UserInterface $user, Zip $zip): bool
    {
        return $user->hasPermissionTo('view zip codes');
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create zip codes');
    }

    public function update(UserInterface $user, Zip $zip): bool
    {
        return $user->hasPermissionTo('update zip codes');
    }

    public function delete(UserInterface $user, Zip $zip): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Zip $zip): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Zip $zip): bool
    {
        return false;
    }
}
