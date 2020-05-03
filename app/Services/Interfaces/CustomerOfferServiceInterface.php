<?php


namespace App\Services\Interfaces;


use Illuminate\Http\Request;

interface CustomerOfferServiceInterface
{

    public function createOffer(Request $request);
    public function acceptOffer($customerOfferId,$driverOfferId,$driverId,$dialogId);
    public function getOffers(Request $request);
    public function acceptOfferFomCustomer($customerOfferId,$driverId,$dialogId);
    public function toCompleteOrder(int $id);
    public function showCompletedOrders(int $userId);
    public function getCompletedOffer(int $id);

}
