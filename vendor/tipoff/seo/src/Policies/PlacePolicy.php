<?php

declare(strict_types=1);

namespace Tipoff\Seo\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Seo\Models\Place;
use Tipoff\Support\Contracts\Models\UserInterface;

class PlacePolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view places') ? true : false;
    }

    public function view(UserInterface $user, Place $place): bool
    {
        return $user->hasPermissionTo('view places') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create places') ? true : false;
    }

    public function update(UserInterface $user, Place $place): bool
    {
        return $user->hasPermissionTo('update places') ? true : false;
    }

    public function delete(UserInterface $user, Place $place): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Place $place): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Place $place): bool
    {
        return false;
    }
}
