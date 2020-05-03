<?php


namespace App\Repositories;


use App\Models\Dialog;
use App\Repositories\Interfaces\DialogRepositoryInterface;

class DialogRepository implements DialogRepositoryInterface
{
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
}
