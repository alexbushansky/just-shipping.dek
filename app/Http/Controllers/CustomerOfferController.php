<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerOfferCreateRequest;

use App\Mail\ChangeCustomerOfferStatus;
use App\Models\CustomerOffer;
use App\Models\Dialog;
use App\Models\Type;
use App\Models\User;
use App\Repositories\Interfaces\CustomerOfferRepositoryInterface;
use App\Services\Interfaces\CustomerOfferServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CustomerOfferController extends Controller
{


    private $customerOfferRepository;
    private $customerOfferService;


    public function __construct(CustomerOfferRepositoryInterface $customerOffer, CustomerOfferServiceInterface $customerOfferService)
    {
        $this->customerOfferRepository = $customerOffer;
        $this->customerOfferService = $customerOfferService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {

        $customerOffers = $this->customerOfferService->getOffers($request);
        $typesOfCargo = Type::all();

        return view('customer.customer-offer.index')->with(
            [
                'customerOffers' => $customerOffers,
                'typesOfCargo' => $typesOfCargo,
            ]
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $user = auth()->user();
        return view('customer.customer-offer.create')->with([
            'customerId' => $user->customer->id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CustomerOfferCreateRequest $request)
    {
        $this->customerOfferService->createOffer($request);

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Factory|View
     */
    public function show($id)
    {

        $customerOffer = CustomerOffer::with('cargoType','fullAddressFrom','fullAddressTo')
            ->find($id);

        $photos = json_decode($customerOffer->gallery);

        $dialogs = Dialog::with('user')
            ->where('dialogable_type', 'App\Models\CustomerOffer')
            ->where('dialogable_id', $id)
            ->get();

        return view('customer.customer-offer.show')->with(
            [
                'customerOffer' => $customerOffer,
                'photos' => $photos,
                'dialogs' => $dialogs,
                'user' => $customerOffer->user,
            ]
        );
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


    public function acceptOffer($id, Request $request): void
    {
        $driverId = $request->driverId;
        if(isset($request->driverOfferId)) {
            $driverOfferId = $request->driverOfferId;

            $this->customerOfferService->acceptOffer($id, $driverOfferId, $driverId);
        }else
        {
            $this->customerOfferService->acceptOfferFomCustomer($id, $driverId);
        }

    }


    public function activeOrders($id)
    {
        $user = User::find($id);

        if($user->hasRole('customer'))
        {
            $customer = $user->customer;
            $orders = CustomerOffer::where('customer_id','=',$customer->id)
                ->with('fullAddressFrom')
                ->with('fullAddressTo')
                ->with('driver')
                ->where('status_id', '=', 2)
                ->orderBy('updated_at', 'desc')
                ->get();
            return \view('order.activeOrder')->with(
                ['orders' => $orders]
            );

        }else if($user->hasRole('driver'))
        {

            $driver = $user->driver;

            $orders = CustomerOffer::where('driver_id','=',$driver->id)
                                    ->with('fullAddressFrom')
                                    ->with('fullAddressTo')
                                    ->with('customer')
                                    ->where('status_id', '=', 2)
                                    ->orderBy('updated_at', 'desc')
                                    ->get();
            return \view('order.activeOrder')->with(
                ['orders' => $orders]
            );
        }else
        {
            abort(403);
        }
    }


    public function showActiveOrder($id)
    {
        $order = CustomerOffer::find($id);
        $latLngFrom = $order->lat_lng_from;
        $latLngTo = $order->lat_lng_to;
        $photos = json_decode($order->gallery);


        return \view('order.showActiveOrder')->with(
            [
                'latLngFrom'=>$latLngFrom,
                'latLngTo'=>$latLngTo,
                'order'=>$order,
                'photos'=>$photos,

            ]
        );
    }

    public function toCompleteOrder($id)
    {

     $this->customerOfferService->toCompleteOrder($id);

    }

    public function showCompletedOrders($userId)
    {
        $orders = $this->customerOfferService->showCompletedOrders($userId);

        return \view('order.completedOrder')->with(
            ['orders'=>$orders]
        );
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
