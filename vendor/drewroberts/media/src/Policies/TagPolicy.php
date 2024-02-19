<?php

declare(strict_types=1);

namespace DrewRoberts\Media\Policies;

use DrewRoberts\Media\Models\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Support\Contracts\Models\UserInterface;

class TagPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user)
    {
        return $user->hasPermissionTo('view tags');
    }

    public function view(UserInterface $user, Tag $tag)
    {
        return $user->hasPermissionTo('view tags');
    }

    public function create(UserInterface $user)
    {
        return $user->hasPermissionTo('create tags');
    }

    public function update(UserInterface $user, Tag $tag)
    {
        return $user->hasPermissionTo('update tags');
    }

    public function delete(UserInterface $user, Tag $tag)
    {
        return $user->hasPermissionTo('delete tags');
    }
}
