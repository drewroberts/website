<?php

declare(strict_types=1);

namespace Tipoff\Seo\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Seo\Models\Webpage;
use Tipoff\Support\Contracts\Models\UserInterface;

class WebpagePolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view webpages') ? true : false;
    }

    public function view(UserInterface $user, Webpage $webpage): bool
    {
        return $user->hasPermissionTo('view webpages') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create webpages') ? true : false;
    }

    public function update(UserInterface $user, Webpage $webpage): bool
    {
        return $user->hasPermissionTo('update webpages') ? true : false;
    }

    public function delete(UserInterface $user, Webpage $webpage): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Webpage $webpage): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Webpage $webpage): bool
    {
        return false;
    }
}
