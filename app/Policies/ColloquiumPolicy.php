<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ColloquiumPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user may view existing colloquia.
     *
     * @return bool
     */
    public function view()
    {
        // Everyone may see all colloquia.
        return true;
    }

    /**
     * Determine whether the user may create new colloquia.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user may update existing colloquia.
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return ($user->isAdmin() || $user->isPlanner());
    }

    /**
     * Determine whether the user may delete existing colloquia.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return ($user->isAdmin() || $user->isPlanner());
    }

    /**
     * Determine whether the user may review existing colloquia.
     *
     * @param User $user
     * @return bool
     */
    public function review(User $user)
    {
        return ($user->isAdmin() || $user->isPlanner());
    }
}
