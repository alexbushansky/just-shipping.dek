<?php

namespace App\Observers;

use App\Models\Dialog;
use App\Models\DialogMessage;
use http\Message;

class DialogOfferObserver
{
    private const IN_ACTIVE_STATUS = 2;
    private const OFFER_STATUS = 1;
    /**
     * Handle the dialog "created" event.
     *
     * @param  \App\Models\Dialog  $dialog
     * @return void
     */
    public function created(Dialog $dialog)
    {
        //
    }

    /**
     * Handle the dialog "updated" event.
     *
     * @param  \App\Models\Dialog  $dialog
     * @return void
     */
    public function updated(Dialog $dialog)
    {

        if ($dialog->status_dialog_id == self::IN_ACTIVE_STATUS)
        {
            Dialog::where('offer_id','=',$dialog->offer_id)
                                    ->where('status_dialog_id','=', self::OFFER_STATUS)
                                    ->delete();

        }
    }

    /**
     * Handle the dialog "deleted" event.
     *
     * @param  \App\Models\Dialog  $dialog
     * @return void
     */
    public function deleted(Dialog $dialog)
    {
        DialogMessage::where('dialog_id','=',$dialog->id)
                    ->delete();
    }

    /**
     * Handle the dialog "restored" event.
     *
     * @param  \App\Models\Dialog  $dialog
     * @return void
     */
    public function restored(Dialog $dialog)
    {
        //
    }

    /**
     * Handle the dialog "force deleted" event.
     *
     * @param  \App\Models\Dialog  $dialog
     * @return void
     */
    public function forceDeleted(Dialog $dialog)
    {
        //
    }
}
