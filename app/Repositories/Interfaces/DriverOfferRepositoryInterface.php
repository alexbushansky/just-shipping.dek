<?php


namespace App\Repositories\Interfaces;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface DriverOfferRepositoryInterface
{
    public function filterDriverOffers($title,  $country_id,$region_id, $city_id): LengthAwarePaginator;
}
