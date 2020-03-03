<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CustomerOffer;
use App\Models\DriverOffer;
use Illuminate\Http\Request;

class DriverOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $request->title;
        $country_id=$request->country_id;
        $region_id=$request->region_id;
        $city_id = $request->city_id;



        $driverOffers = DriverOffer::with('country','region','city')
            ->when($country_id,function ($query,$country_id) {
                return $query->where('country_id','=',$country_id);
            })
            ->when($region_id,function ($query,$region_id) {
                return $query->where('region_id','=',$region_id);
            })->when($city_id,function ($query,$city_id) {
                return $query->where('city_id','=',$city_id);
            })->when($title,function ($query,$title) {
                return $query->where('title','LIKE','%'.$title.'%');
            })
            ->paginate(5)
            ->appends(request()->query());

        $countries = Country::all();



        return view('driver.driver-offer.index',[
            'driverOffers'=>$driverOffers,
            'countries'=>$countries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DriverOffer  $driverOffer
     * @return \Illuminate\Http\Response
     */
    public function show(DriverOffer $driverOffer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DriverOffer  $driverOffer
     * @return \Illuminate\Http\Response
     */
    public function edit(DriverOffer $driverOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DriverOffer  $driverOffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DriverOffer $driverOffer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DriverOffer  $driverOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(DriverOffer $driverOffer)
    {
        //
    }


    public function sendMessage(Request $request)
    {

        return response()->json([
           "success" =>true,
            'req'=>$request->all(),
        ]);
    }
}
