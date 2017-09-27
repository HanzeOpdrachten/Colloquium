<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user may view trainings.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return ($user->isPlanner() || $user->isAdmin());
    }

    /**
     * Determine whether the user may create trainings.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return ($user->isPlanner() || $user->isAdmin());
    }

    /**
     * Determine whether the user may update trainings.
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return ($user->isPlanner() || $user->isAdmin());
    }

    /**
     * Determine whether the user may delete trainings.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return ($user->isPlanner() || $user->isAdmin());
    }

    /**
     * Determine whether the user may subscribe to a training.
     *
     * @param User $user
     * @return bool
     */
    public function subscribe(User $user)
    {
        return ($user->isPlanner());
    }
}
