<?php


namespace App\Services\Interfaces;


use Illuminate\Http\Request;

interface DriverOfferServiceInterface
{
    public function changeStatus($id);
    public function createOffer(Request $request);
}
