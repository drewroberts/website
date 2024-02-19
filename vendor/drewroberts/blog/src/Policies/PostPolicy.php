<?php

namespace DrewRoberts\Blog\Policies;

use DrewRoberts\Blog\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Support\Contracts\Models\UserInterface;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user)
    {
        return $user->hasPermissionTo('view posts');
    }

    public function view(UserInterface $user, Post $post)
    {
        return $user->hasPermissionTo('view posts');
    }

    public function create(UserInterface $user)
    {
        return $user->hasPermissionTo('create posts');
    }

    public function update(UserInterface $user, Post $post)
    {
        return $user->hasPermissionTo('update posts');
    }
    
    public function delete(UserInterface $user, Post $post)
    {
        return false;
    }

    public function restore(UserInterface $user, Post $post)
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Post $post)
    {
        return false;
    }
}
