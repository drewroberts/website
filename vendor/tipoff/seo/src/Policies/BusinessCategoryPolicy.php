<?php

declare(strict_types=1);

namespace Tipoff\Seo\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Seo\Models\BusinessCategory;
use Tipoff\Support\Contracts\Models\UserInterface;

class BusinessCategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view business categories') ? true : false;
    }

    public function view(UserInterface $user, BusinessCategory $business_category): bool
    {
        return $user->hasPermissionTo('view business categories') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create business categories') ? true : false;
    }

    public function update(UserInterface $user, BusinessCategory $business_category): bool
    {
        return $user->hasPermissionTo('update business categories') ? true : false;
    }

    public function delete(UserInterface $user, BusinessCategory $business_category): bool
    {
        return false;
    }

    public function restore(UserInterface $user, BusinessCategory $business_category): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, BusinessCategory $business_category): bool
    {
        return false;
    }
}
