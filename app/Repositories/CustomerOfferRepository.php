<?php


namespace App\Repositories;


use App\Models\Address;
use App\Models\CustomerOffer;

use App\Repositories\Interfaces\CustomerOfferRepositoryInterface;
use Illuminate\Http\Request;

class CustomerOfferRepository implements CustomerOfferRepositoryInterface
{

    private $customerOffer;


    public function __construct(CustomerOffer $customerOffer)
    {
        $this->customerOffer = $customerOffer;
    }

    public function getAllOffers()
    {
      return $this->customerOffer::with('addressFrom','addressTo','cargoType')
                                    ->paginate(6)
                                    ->appends(request()->query());
    }

    public function createOffer(Request $request)
    {
           $addressFirst = new Address();
           $addressFirst->street_name = $request->street_one;
           $addressFirst->house_number = $request->house_one;
           $addressFirst->country_id = $request->country_one;
           $addressFirst->region_id = $request->region_one;
           $addressFirst->city_id = $request->city_one;

        $addressSecond = new Address();
        $addressSecond->street_name = $request->street_two;
        $addressSecond->house_number = $request->house_two;
        $addressSecond->country_id = $request->country_two;
        $addressSecond->region_id = $request->region_two;
        $addressSecond->city_id = $request->city_two;

        if($addressSecond->save() && $addressFirst->save())
        {
            $this->customerOffer->title = $request->nameOfOrder;
            $this->customerOffer->description = $request->description;
            $this->customerOffer->address_from_id = $addressFirst->id;
            $this->customerOffer->address_to_id = $addressSecond->id;
            $this->customerOffer->weight= $request->weight;
            $this->customerOffer->price_per_km= $request->price_per_km;
            $this->customerOffer->date_start= date("Y-m-d");
            $this->customerOffer->date_finish= $request->date_finish;
            $this->customerOffer->status_id= 1;
            $this->customerOffer->customer_id= $request->customer_id;
        }

       if( $this->customerOffer->save())
       {
           $this->customerOffer->cargoType()->sync($request->types);
       }


    }
}
