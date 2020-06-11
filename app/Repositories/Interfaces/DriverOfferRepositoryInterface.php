<?php


namespace App\Repositories\Interfaces;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface DriverOfferRepositoryInterface
{
    public function filterDriverOffers($title,  $country_id,$region_id, $city_id,$weight,$capacity,$type,$price_per_km): LengthAwarePaginator;
    public function acceptedOffer($driverOfferId);
    public function createOffer(Request $request);
    public function deleteDriverOffer(int $id);
}
