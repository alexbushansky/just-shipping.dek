<?php


namespace App\Repositories;


use App\Models\Dialog;
use App\Repositories\Interfaces\DialogRepositoryInterface;

class DialogRepository implements DialogRepositoryInterface
{

    public function changeStatus($id)
    {
        // TODO: Implement changeStatus() method.
    }

    public function showDriverDialogs(int $id)
    {

        $dialog = Dialog::with('recipient')
            ->where('user_id','=',$id)
            ->where('dialogable_type','=','App\Models\CustomerOffer')
            ->with('driverOffer')
            ->get();

        return $dialog;

    }

    public function showCustomerDialogs(int $id)
    {


        $dialog = Dialog::with('recipient')
            ->where('user_id','=',$id)
            ->where('dialogable_type','=','App\Models\DriverOffer')
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
}
