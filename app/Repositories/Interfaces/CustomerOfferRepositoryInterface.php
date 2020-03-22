<?php


namespace App\Repositories\Interfaces;


use Illuminate\Http\Request;

interface CustomerOfferRepositoryInterface
{

    public function getAllOffers();
    public function createOffer(Request $request);

}
