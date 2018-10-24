<?php

namespace App\Policies;

use App\User;
use App\Parking;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParkingPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the parking.
     *
     * @param  \App\User  $user
     * @param  \App\Parking  $parking
     * @return mixed
     */
    public function view(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can create parkings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the parking.
     *
     * @param  \App\User  $user
     * @param  \App\Parking  $parking
     * @return mixed
     */
    public function update(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the parking.
     *
     * @param  \App\User  $user
     * @param  \App\Parking  $parking
     * @return mixed
     */
    public function delete(User $user)
    {
        return false;
    }

    public function index(User $user)
    {
        return false;
    }
}
