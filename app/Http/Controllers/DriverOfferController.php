<?php

namespace App\Http\Controllers;




use App\Http\Requests\DriverOfferCreateRequest;

use App\Models\CustomerOffer;
use App\Models\Dialog;

use App\Models\DriverOffer;
use App\Models\Type;
use App\Repositories\Interfaces\DriverOfferRepositoryInterface;
use App\Services\Interfaces\DriverOfferServiceInterface;
use App\Services\Interfaces\FileServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class DriverOfferController extends Controller
{

    protected $driverOfferRepository;
    protected $fileService;
    private $driverOfferService;

    public function __construct(DriverOfferRepositoryInterface $driverOfferRepository,FileServiceInterface $fileService,DriverOfferServiceInterface $driverOfferService)
    {
        $this->driverOfferRepository=$driverOfferRepository;
        $this->fileService = $fileService;
        $this->driverOfferService = $driverOfferService;
        $this->middleware('check.driver.offer', ['only' => ['show']]);
        $this->middleware(['check.creating.driver.offer','auth'],['only'=>['create','store']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {


        $title = $request->title;
        $country_id=$request->country_id;
        $region_id=$request->region_id;
        $city_id = $request->city_id;
        $weight = $request->weight;
        $capacity = $request->capacity;
        $type = $request->type_of_cargo;

        $types = Type::all();

       $driverOffers = $this->driverOfferRepository->filterDriverOffers($title,$country_id,$region_id,$city_id,$weight,$capacity,$type);
        $max = $driverOffers->max('weight');



        return view('driver.driver-offer.index')->with([
            'driverOffers'=>$driverOffers,
            'types' => $types,
            'max' => $max,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {

        $this->authorize('create',DriverOffer::class);

        $userDriver=auth()->user()->driver;


        return view('driver.driver-offer.create')->with([
            'driverId'=>$userDriver->id,
            'driverCar'=>$userDriver->driverCar,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DriverOfferCreateRequest $request
     * @return RedirectResponse
     */
    public function store(DriverOfferCreateRequest $request)
    {

        if($this->driverOfferService->createOffer($request))
        {
            return redirect()->route('driver-offers.create')->with([
                'status' => 'Заявка создана успешно',
                'alert' => 'success',]);
        }
        else
        {
            return redirect()->route('driver-offers.create')->with([
                'status' => 'Ошибка Создания',
                'alert' => 'error',]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DriverOffer  $driverOffer
     * @return Factory|View
     */
    public function show($id)
    {


        $driverOffer = DriverOffer::with('dialogs','driver')
                                    ->leftJoin('driver_cars','driver_car_id','=','driver_cars.car_id')
                                    ->find($id);

        $offerInfo= ['cityName'=>$driverOffer->city->name,
                        'phone'=>$driverOffer->driver->user->phone_number];

        $dialogs = Dialog::with('user')
            ->where('offer_type','App\Models\DriverOffer')
            ->where('offer_id',$id)
            ->get();



       $customerId=null;
       $customerOffer=null;
       if(auth()->user()) {
           $user = auth()->user();
           if ($user->hasRole('customer') || $user->hasRole('driver')) {
               if ($user->hasRole('customer')) {
                   $customerId = $user->customer->id;


                   $customerOffer = CustomerOffer::select('id', 'title', 'customer_id')
                       ->where('status_id', 1)
                       ->where('customer_id', $customerId)
                       ->get();
               } else if ($user->driver->id == $driverOffer->driver_id) {
                   $customerOffer = CustomerOffer::select('id', 'title', 'customer_id')
                       ->where('status_id', 1)
                       ->get();

               }
           } else if ($user->hasRole('admin') || !$user) {
               $customerOffer = CustomerOffer::select('id', 'title', 'customer_id')
                   ->where('status_id', 1)
                   ->get();
           }
       }else
       {
           $customerOffer = CustomerOffer::select('id', 'title', 'customer_id')
               ->where('status_id', 1)
               ->get();
       }



        return view('driver.driver-offer.show',['driverOffer'=>$driverOffer,
            'dialogs'=>$dialogs,
            'offerInfo'=>$offerInfo,
            'customerOffer'=>$customerOffer,
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
     * @param Request $request
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
