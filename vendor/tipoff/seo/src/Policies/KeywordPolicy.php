<?php

declare(strict_types=1);

namespace Tipoff\Seo\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Seo\Models\Keyword;
use Tipoff\Support\Contracts\Models\UserInterface;

class KeywordPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view keywords') ? true : false;
    }

    public function view(UserInterface $user, Keyword $keyword): bool
    {
        return $user->hasPermissionTo('view keywords') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create keywords') ? true : false;
    }

    public function update(UserInterface $user, Keyword $keyword): bool
    {
        return $user->hasPermissionTo('update keywords') ? true : false;
    }

    public function delete(UserInterface $user, Keyword $keyword): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Keyword $keyword): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Keyword $keyword): bool
    {
        return false;
    }
}
