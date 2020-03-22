<?php

namespace App\Http\Controllers;




use App\Http\Requests\DriverOfferCreateRequest;

use App\Models\Dialog;

use App\Models\DriverOffer;
use App\Repositories\Interfaces\DriverOfferRepositoryInterface;
use App\Services\Interfaces\FileServiceInterface;
use Illuminate\Http\Request;



class DriverOfferController extends Controller
{

    protected $driverOfferRepository;
    protected $fileService;

    public function __construct(DriverOfferRepositoryInterface $driverOfferRepository,FileServiceInterface $fileService)
    {
        $this->driverOfferRepository=$driverOfferRepository;
        $this->fileService = $fileService;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = $request->title;
        $country_id=$request->country_id;
        $region_id=$request->region_id;
        $city_id = $request->city_id;


       $driverOffers = $this->driverOfferRepository->filterDriverOffers($title,$country_id,$region_id,$city_id);


        return view('driver.driver-offer.index')->with([
            'driverOffers'=>$driverOffers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->authorize('create',DriverOffer::class);
        $user=auth()->user();

        return view('driver.driver-offer.create')->with([
            'driverId'=>$user->driver->id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DriverOfferCreateRequest $request)
    {


        $driverOffer = new DriverOffer();
        $driverOffer->title = $request->nameOfOrder;
        $driverOffer->description = $request->description;
        $driverOffer->country_id = $request->country;
        $driverOffer->region_id = $request->region;
        $driverOffer->city_id = $request->city;
        $driverOffer->price_per_km = $request->price_per_km;
        $driverOffer->internal_width = $request->internal_width;
        $driverOffer->internal_height = $request->internal_height;
        $driverOffer->internal_length = $request->internal_length;
        $driverOffer->capacity = $request->capacity;
        $driverOffer->max_weight = $request->max_weight;
        $driverOffer->cars_type_id = $request->carType;
        $driverOffer->driver_id = $request->driver_id;
        if ($request->hasFile('photo')) {
            // проверяем существование дирректорий для изображений
            // если нет , то создаем дирректории
            $driverOffer->thumbnail = $this->fileService->makeCarPhoto($request->photo);
        }


        $driverOffer->status_id = 1;
        $driverOffer->save();



        $driverOffer->types()->sync($request->types);








        return redirect()->route('driver-offers.create')->with([
            'status' => 'Заявка создана успешно',
            'alert' => 'success',]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DriverOffer  $driverOffer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $driverOffer = DriverOffer::with('dialogs')->find($id);

        $dialogs = Dialog::with('user')->where('dialogable_id',$id)->get();

        $offerInfo= ['cityName'=>$driverOffer->city()->get()[0]->name];


        return view('driver.driver-offer.show',['driverOffer'=>$driverOffer,
            'dialogs'=>$dialogs,
            'offerInfo'=>$offerInfo,
                            ]);
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
