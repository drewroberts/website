<?php

declare(strict_types=1);

namespace Tipoff\Seo\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Seo\Models\Domain;
use Tipoff\Support\Contracts\Models\UserInterface;

class DomainPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view domains') ? true : false;
    }

    public function view(UserInterface $user, Domain $domain): bool
    {
        return $user->hasPermissionTo('view domains') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create domains') ? true : false;
    }

    public function update(UserInterface $user, Domain $domain): bool
    {
        return $user->hasPermissionTo('update domains') ? true : false;
    }

    public function delete(UserInterface $user, Domain $domain): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Domain $domain): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Domain $domain): bool
    {
        return false;
    }
}
