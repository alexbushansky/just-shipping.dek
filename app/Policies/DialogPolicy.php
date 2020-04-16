<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Dialog;
use Illuminate\Auth\Access\HandlesAuthorization;

class DialogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any dialogs.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

    }

    /**
     * Determine whether the user can view the dialog.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dialog  $dialog
     * @return mixed
     */
    public function show(Dialog $dialog)
    {
        $user = auth()->user();

        return $dialog->user_id == $user->id || $dialog->recipient_id == $user->id;

    }

    /**
     * Determine whether the user can create dialogs.
     *
     * @param int $userId
     * @param int $offerId
     * @return mixed
     */
    public function create(int $userId, int $offerId)
    {
        $dialogs = Dialog::select('offer_id')
                            ->groupBy('user_id','offer_id')
                            ->where('user_id','=',$userId)
                            ->where('offer_id','=', $offerId)
                            ->get()->count();
        if($dialogs>=1)
        {
            return false;
        }else
        {
            return true;
        }


    }

    /**
     * Determine whether the user can update the dialog.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dialog  $dialog
     * @return mixed
     */
    public function update(User $user, Dialog $dialog)
    {
        return $dialog->user_id == $user->id || $dialog->recipient_id == $user->id;
    }

    /**
     * Determine whether the user can delete the dialog.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dialog  $dialog
     * @return mixed
     */
    public function delete(User $user, Dialog $dialog)
    {
        return $dialog->user_id == $user->id;
    }


}
