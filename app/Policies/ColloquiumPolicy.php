<?php

namespace App\Policies;

use App\Colloquium;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ColloquiumPolicy
 *
 * @package App\Policies
 */
class ColloquiumPolicy
{
    use HandlesAuthorization;

    /*
     * Note: Whenever a user is logged in, it has the role `Planner` OR `Administrator`.
     *       Both roles are authorized to do whatever action is available in this policy.
     *       That's why we don't have to check the role of the user beforehand.
     */

    /**
     * Determine whether the user may view existing colloquia.
     *
     * @return bool
     */
    public function view()
    {
        return true;
    }

    /**
     * Determine whether the user may create new colloquia.
     *
     * Everyone can create a new colloquium.
     *
     * @return bool
     */
    public function create()
    {
        return true;
    }

    /**
     * Determine whether the user may update an existing colloquium.
     *
     * @return bool
     */
    public function update()
    {
        return true;
    }

    /**
     * Determine whether the user may delete existing colloquia.
     *
     * @return bool
     */
    public function delete()
    {
        return true;
    }

    /**
     * Determine whether the user may review existing colloquia.
     *
     * @return bool
     */
    public function review()
    {
        return true;
    }

    /**
     * Determine whether a colloquium may be accepted or not.
     *
     * Only a colloquium with the status `awaiting` may be accepted.
     *
     * @param User $user
     * @param Colloquium $colloquium
     * @return bool
     */
    public function accept(User $user, Colloquium $colloquium)
    {
        return ($colloquium->isAwaiting());
    }

    /**
     * Determine whether a colloquium may be declined or not.
     *
     * Only a colloquium with the status `awaiting` me be declined.
     *
     * @param User $user
     * @param Colloquium $colloquium
     * @return bool
     */
    public function decline(User $user, Colloquium $colloquium)
    {
        return ($colloquium->isAwaiting());
    }

    /**
     * Determine whether the colloquium may be canceled or not.
     *
     * Only a colloquium with the status `accepted` may be canceled.
     *
     * @param User $user
     * @param Colloquium $colloquium
     * @return bool
     */
    public function cancel(User $user, Colloquium $colloquium)
    {
        return ($colloquium->isAccepted());
    }
}
