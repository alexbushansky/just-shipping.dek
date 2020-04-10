<?php


namespace App\Repositories\Interfaces;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface DriverOfferRepositoryInterface
{
    public function filterDriverOffers($title,  $country_id,$region_id, $city_id,$weight,$capacity,$type): LengthAwarePaginator;
    public function acceptedOffer($driverOfferId);
    public function createOffer(Request $request);
}
