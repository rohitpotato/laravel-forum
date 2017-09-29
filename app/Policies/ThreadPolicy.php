<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Thread;
use App\User;
class ThreadPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Thread $thread)
    {
        return $thread->user_id == $user->id;
    }
}
