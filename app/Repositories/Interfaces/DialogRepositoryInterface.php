<?php


namespace App\Repositories\Interfaces;


interface DialogRepositoryInterface
{
    public function changeStatusToAccepted(int $dialogId);

    public function showDriverDialogs(int $id);
    public function showCustomerDialogs(int $id);
    public function showOffersDialog(int $id);
    public function completedDialog(int $offerId);
    public function create(int $userId, int $customerOfferId, String $type, int $offerId,$model);
}
