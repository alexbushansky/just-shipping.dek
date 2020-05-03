<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DriverOffer;
use Illuminate\Auth\Access\HandlesAuthorization;

class DriverOfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any driver offers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the driver offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DriverOffer  $driverOffer
     * @return mixed
     */
    public function view(User $user, DriverOffer $driverOffer)
    {
        //
    }

    /**
     * Determine whether the user can create driver offers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isDriver();
    }

    /**
     * Determine whether the user can update the driver offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DriverOffer  $driverOffer
     * @return mixed
     */
    public function update(User $user, DriverOffer $driverOffer)
    {
        //
    }

    /**
     * Determine whether the user can delete the driver offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DriverOffer  $driverOffer
     * @return mixed
     */
    public function delete(User $user, DriverOffer $driverOffer)
    {

    }

    /**
     * Determine whether the user can restore the driver offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DriverOffer  $driverOffer
     * @return mixed
     */
    public function restore(User $user, DriverOffer $driverOffer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the driver offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DriverOffer  $driverOffer
     * @return mixed
     */
    public function forceDelete(User $user, DriverOffer $driverOffer)
    {
        //
    }
}
