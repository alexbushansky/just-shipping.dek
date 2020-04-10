<?php


namespace App\Services\Interfaces;


use Illuminate\Http\Request;

interface CustomerOfferServiceInterface
{

    public function createOffer(Request $request);
    public function acceptOffer($customerOfferId,$driverOfferId,$driverId);
    public function getOffers(Request $request);
    public function acceptOfferFomCustomer($customerOfferId,$driverId);
    public function toCompleteOrder(int $id);
    public function showCompletedOrders(int $userId);

}
