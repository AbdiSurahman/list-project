<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
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

    public function update($user, $task)
    {
        return $user->id == $task->user_id;
    }

    public function delete($user, $task)
    {
        return $user->id == $task->user_id;
    }

    public function progress($user, $task) 
    {
        return $user->id == $task->user_id;
    }

    public function move($user, $task)
    {
        return $user->id == $task->user_id;
    }
}
