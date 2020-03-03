<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CarType;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarTypePolice
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any car types.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the car type.
     *
     * @param User $user
     * @param CarType $carType
     * @return mixed
     */
    public function view(User $user, CarType $carType)
    {
        //
    }

    /**
     * Determine whether the user can create car types.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        dd($user);
    }

    /**
     * Determine whether the user can update the car type.
     *
     * @param User $user
     * @param CarType $carType
     * @return mixed
     */
    public function update(User $user, CarType $carType)
    {

        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the car type.
     *
     * @param User $user
     * @param CarType $carType
     * @return mixed
     */
    public function delete(User $user, CarType $carType)
    {

        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the car type.
     *
     * @param User $user
     * @param CarType $carType
     * @return mixed
     */
    public function restore(User $user, CarType $carType)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the car type.
     *
     * @param User $user
     * @param CarType $carType
     * @return mixed
     */
    public function forceDelete(User $user, CarType $carType)
    {
        //
    }
}
