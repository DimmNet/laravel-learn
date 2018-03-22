<?php

namespace App\Policies;

use App\Tasks;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TasksPolicy
{
    use HandlesAuthorization;

    /**
     * ѕровер€ем доступ на редактирование задачи.
     *
     * @param User $user
     * @param Tasks $tasks
     * @return bool
     */
    public function update(User $user, Tasks $tasks)
    {
        return $user->id === $tasks->user_id;
    }

    /**
     * ѕровер€ем доступ на удаление задачи.
     *
     * @param User $user
     * @param Tasks $tasks
     * @return bool
     */
    public function delete(User $user, Tasks $tasks)
    {
        return $user->id === $tasks->user_id;
    }
}
