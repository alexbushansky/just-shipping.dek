<?php


namespace App\Repositories\Interfaces;


interface DialogRepositoryInterface
{
    public function changeStatus($id);
    public function showDriverDialogs(int $id);
    public function showCustomerDialogs(int $id);
    public function showOffersDialog(int $id);
}
