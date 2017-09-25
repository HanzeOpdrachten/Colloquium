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
        if ($user->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user may create users.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }

        return false;
    }
}
