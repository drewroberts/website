<?php

namespace DrewRoberts\Blog\Policies;

use DrewRoberts\Blog\Models\Topic;
use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Support\Contracts\Models\UserInterface;

class TopicPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user)
    {
        return $user->hasPermissionTo('view topics');
    }

    public function view(UserInterface $user, Topic $topic)
    {
        return $user->hasPermissionTo('view topics');
    }

    public function create(UserInterface $user)
    {
        return $user->hasPermissionTo('create topics');
    }

    public function update(UserInterface $user, Topic $topic)
    {
        return $user->hasPermissionTo('update topics');
    }
    
    public function delete(UserInterface $user, Topic $topic)
    {
        return false;
    }

    public function restore(UserInterface $user, Topic $topic)
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Topic $topic)
    {
        return false;
    }
}
