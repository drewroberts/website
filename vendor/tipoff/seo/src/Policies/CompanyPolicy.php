<?php

declare(strict_types=1);

namespace Tipoff\Seo\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Seo\Models\Company;
use Tipoff\Support\Contracts\Models\UserInterface;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view companies') ? true : false;
    }

    public function view(UserInterface $user, Company $company): bool
    {
        return $user->hasPermissionTo('view companies') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create companies') ? true : false;
    }

    public function update(UserInterface $user, Company $company): bool
    {
        return $user->hasPermissionTo('update companies') ? true : false;
    }

    public function delete(UserInterface $user, Company $company): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Company $company): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Company $company): bool
    {
        return false;
    }
}
