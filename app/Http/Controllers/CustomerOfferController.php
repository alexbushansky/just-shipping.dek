<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CustomerOffer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $title = $request->title;
        $country_id=$request->country_id;
        $region_id=$request->region_id;
        $city_id = $request->city_id;



        $customerOffers = CustomerOffer::when($country_id,function ($query,$country_id)
        {
            return $query->where('country_id','=',$country_id);
        })->paginate(15);
        dd($customerOffers);


        $countries = Country::all();


        return view('customer.customer-offer.index',[
            'customerOffers'=>$customerOffers,
            'countries'=>$countries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param CustomerOffer $customerOffer
     * @return Response
     */
    public function show(CustomerOffer $customerOffer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CustomerOffer $customerOffer
     * @return Response
     */
    public function edit(CustomerOffer $customerOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param CustomerOffer $customerOffer
     * @return Response
     */
    public function update(Request $request, CustomerOffer $customerOffer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CustomerOffer $customerOffer
     * @return Response
     */
    public function destroy(CustomerOffer $customerOffer)
    {
        //
    }
}
