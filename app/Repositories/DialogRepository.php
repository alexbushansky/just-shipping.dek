<?php


namespace App\Repositories;


use App\Models\CustomerOffer;
use App\Models\Dialog;
use App\Models\DriverOffer;
use App\Repositories\Interfaces\DialogRepositoryInterface;

class DialogRepository implements DialogRepositoryInterface
{
    private const IN_ACTIVE_STATUS = 1;
    private const IN_PROGRESS_STATUS = 2;
    private const COMPLETED_STATUS = 3;


    public function changeStatusToAccepted(int $dialogId)
    {

        Dialog::find($dialogId)->update(['status_dialog_id'=>self::IN_PROGRESS_STATUS]);

    }



    public function showDriverDialogs(int $id)
    {

        $dialog = Dialog::with('recipient')
            ->where('user_id','=',$id)
            ->where('offer_type','=','App\Models\CustomerOffer')
            ->with('driverOffer')
            ->get();

        return $dialog;

    }

    public function showCustomerDialogs(int $id)
    {


        $dialog = Dialog::with('recipient')
            ->where('user_id','=',$id)
            ->where('offer_type','=','App\Models\DriverOffer')
            ->with('customerOffer')
            ->get();

        return $dialog;
    }
    public function showOffersDialog(int $id)
    {
        $dialog = Dialog::where('recipient_id','=',$id)
                            ->get();

        return $dialog;
    }

    public function completedDialog(int $offerId)
    {
        Dialog::where('offer_id','=',$offerId)
                ->update(['status_dialog_id' => self::COMPLETED_STATUS]);

    }

    public function create(int $userId, int $customerOfferId, String $type, int $offerId,$model)
    {
            $dialog = new Dialog();
            $dialog->user_id = $userId;
            $dialog->status_dialog_id = self::IN_ACTIVE_STATUS;

         if ($type == 'CustomerOffer')
             $dialog->recipient_id = CustomerOffer::find($offerId)->customer->user->id;
         else {
                 $dialog->recipient_id = DriverOffer::find($offerId)->driver->user->id;
                 $dialog->customer_offer_id = $customerOfferId;
             }
             $model->dialogs()->save($dialog);

            $dialog->increment('recipient_new', 1);
            return $dialog;
         }

}
