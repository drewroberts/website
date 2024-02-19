<?php

declare(strict_types=1);

namespace Tipoff\GoogleApi\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\GoogleApi\Models\GmbAccount;
use Tipoff\Support\Contracts\Models\UserInterface;

class GmbAccountPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view gmb accounts') ? true : false;
    }

    public function view(UserInterface $user, GmbAccount $gmb_account): bool
    {
        return $user->hasPermissionTo('view gmb accounts') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create gmb accounts') ? true : false;
    }

    public function update(UserInterface $user, GmbAccount $gmb_account): bool
    {
        return $user->hasPermissionTo('update gmb accounts') ? true : false;
    }

    public function delete(UserInterface $user, GmbAccount $gmb_account): bool
    {
        return false;
    }

    public function restore(UserInterface $user, GmbAccount $gmb_account): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, GmbAccount $gmb_account): bool
    {
        return false;
    }
}
