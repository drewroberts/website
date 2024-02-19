<?php

declare(strict_types=1);

namespace Tipoff\Seo\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Seo\Models\Ranking;
use Tipoff\Support\Contracts\Models\UserInterface;

class RankingPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view rankings') ? true : false;
    }

    public function view(UserInterface $user, Ranking $ranking): bool
    {
        return $user->hasPermissionTo('view rankings') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create rankings') ? true : false;
    }

    public function update(UserInterface $user, Ranking $ranking): bool
    {
        return $user->hasPermissionTo('update rankings') ? true : false;
    }

    public function delete(UserInterface $user, Ranking $ranking): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Ranking $ranking): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Ranking $ranking): bool
    {
        return false;
    }
}
