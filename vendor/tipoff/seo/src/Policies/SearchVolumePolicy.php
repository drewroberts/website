<?php

declare(strict_types=1);

namespace Tipoff\Seo\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Seo\Models\SearchVolume;
use Tipoff\Support\Contracts\Models\UserInterface;

class SearchVolumePolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view search volumes') ? true : false;
    }

    public function view(UserInterface $user, SearchVolume $search_volume): bool
    {
        return $user->hasPermissionTo('view search volumes') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create search volumes') ? true : false;
    }

    public function update(UserInterface $user, SearchVolume $search_volume): bool
    {
        return $user->hasPermissionTo('update search volumes') ? true : false;
    }

    public function delete(UserInterface $user, SearchVolume $search_volume): bool
    {
        return false;
    }

    public function restore(UserInterface $user, SearchVolume $search_volume): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, SearchVolume $search_volume): bool
    {
        return false;
    }
}
