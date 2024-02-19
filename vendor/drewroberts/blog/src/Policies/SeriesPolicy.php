<?php

namespace DrewRoberts\Blog\Policies;

use DrewRoberts\Blog\Models\Series;
use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Support\Contracts\Models\UserInterface;

class SeriesPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user)
    {
        return $user->hasPermissionTo('view series');
    }

    public function view(UserInterface $user, Series $series)
    {
        return $user->hasPermissionTo('view series');
    }

    public function create(UserInterface $user)
    {
        return $user->hasPermissionTo('create series');
    }

    public function update(UserInterface $user, Series $series)
    {
        return $user->hasPermissionTo('update series');
    }
    
    public function delete(UserInterface $user, Series $series)
    {
        return false;
    }

    public function restore(UserInterface $user, Series $series)
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Series $series)
    {
        return false;
    }
}
