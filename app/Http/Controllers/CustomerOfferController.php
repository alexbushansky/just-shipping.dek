<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerOfferCreateRequest;
use App\Models\Country;
use App\Models\CustomerOffer;
use App\Repositories\Interfaces\CustomerOfferRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerOfferController extends Controller
{





    private $customerOfferRepository;

    public function __construct(CustomerOfferRepositoryInterface $customerOffer)
    {
        $this->customerOfferRepository=$customerOffer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
       $customerOffers  = $this->customerOfferRepository->getAllOffers();


        return view('customer.customer-offer.index')->with( ['customerOffers'=>$customerOffers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user=auth()->user();
        return view('customer.customer-offer.create')->with([
            'customerId' =>$user->customer->id,
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
        $this->customerOfferRepository->createOffer($request);

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
