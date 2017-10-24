<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user may view users.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return ($user->isAdmin());
    }

    /**
     * Determine whether the user may create users.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return ($user->isAdmin());
    }

    /**
     * Determine whether the user may update an existing user.
     *
     * @param User $user
     * @param User $target
     * @return bool
     */
    public function update(User $user, User $target)
    {
        if ($user->id == $target->id) {
            return true;
        }

        return ($user->isAdmin());
    }

    /**
     * Determine whether the user may update a user's role.
     *
     * @param User $user
     * @param User $target
     * @return bool
     */
    public function updateRole(User $user, User $target)
    {
        return ($user->id != $target->id);
    }

    /**
     * Determine whether the user may delete an existing user.
     *
     * @param User $user
     * @param User $target
     * @return bool
     */
    public function delete(User $user, User $target)
    {
        if ($user->id == $target->id) {
            return false;
        }

        return ($user->isAdmin());
    }
}
