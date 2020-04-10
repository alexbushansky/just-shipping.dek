<?php


namespace App\Services;



use App\Models\User;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Repositories\Interfaces\CustomerOfferRepositoryInterface;
use App\Services\Interfaces\CustomerOfferServiceInterface;
use App\Services\Interfaces\DriverOfferServiceInterface;
use App\Services\Interfaces\FileServiceInterface;
use Illuminate\Http\Request;


class CustomerOfferService implements CustomerOfferServiceInterface
{


    private $customerOffer;
    private $address;
    private $fileService;
    private $driverOfferService;


    public function __construct(CustomerOfferRepositoryInterface $customerOffer,
                                AddressRepositoryInterface $address,
                                FileServiceInterface $fileService,
                                DriverOfferServiceInterface $driverOfferService)
    {
        $this->customerOffer = $customerOffer;
        $this->address = $address;
        $this->fileService = $fileService;
        $this->driverOfferService = $driverOfferService;

    }
    public function createOffer(Request $request)
    {
        $addressFirst = $this->address->create($request->street_one,
            $request->house_one,$request->country_one
            ,$request->region_one,$request->city_one);

        $addressSecond = $this->address->create($request->street_two,
            $request->house_two,$request->country_two
            ,$request->region_two,$request->city_two);

        if( $addressFirst && $addressSecond)
        {
            foreach ($request->file('photo') as $photo){
                $filesArr[] = $this->fileService->makeOfferPhoto($photo);
            }
            $this->customerOffer->createOffer($request->nameOfOrder,$request->description,$addressFirst->id,
                                             $addressSecond->id,$request->weight,$request->price_per_km,
                                             $request->date_finish,$request->customer_id,$request->types,
                                                $filesArr,$request->addressOne,$request->addressTwo,$request->capacity);
        }




    }

    public function acceptOffer($customerOfferId,$driverOfferId,$driverId)
    {
        if(isset($customerOfferId) && isset($driverOfferId) && isset($driverId))
        {
            if(is_numeric($customerOfferId) && is_numeric($driverOfferId)&& is_numeric($driverId)) {
                $offer = $this->customerOffer->acceptedOffer($customerOfferId, $driverId);
                $user = $offer->customer->user;
                //Mail::to($user)->send(new ChangeCustomerOfferStatus($offer));
                $this->driverOfferService->changeStatus($driverOfferId);
            }
        }
    }

    public function acceptOfferFomCustomer($customerOfferId,$driverId)
    {
        if(isset($customerOfferId)  && isset($driverId))
        {
            $offer = $this->customerOffer->acceptedOffer($customerOfferId, $driverId);
            $user = $offer->customer->user;
            //Mail::to($user)->send(new ChangeCustomerOfferStatus($offer));
        }
    }

    public function getOffers(Request $request)
    {
       return $this->customerOffer->getAllOffers($request->title,$request->country_id_from,$request->region_id_from,$request->city_id_from,
            $request->country_id_to,$request->region_id_to,$request->city_id_to,$request->price_per_km,$request->capacity,
            $request->weight,$request->type_of_cargo);

    }


    public function toCompleteOrder(int $id)
    {
     if(auth()->user()->hasRole('customer')) {
         if (isset($id) && is_numeric($id)) {
             return $this->customerOffer->completeOffer($id);
         }

         throw new \Exception('Search Error');
     }

        throw new \Exception('Role Error');

    }

    public function showCompletedOrders(int $userId)
    {
        $user = User::find($userId);

        if($user->hasRole('customer')) {

            $customer = $user->customer;

            return $this->customerOffer->showCompletedCustomerOrders($customer);

        }else if($user->hasRole('driver'))
        {
            $driver = $user->driver;
            return $this->customerOffer->showCompletedDriverOrders($driver);
        }
        else
        {
            abort(404);
        }
    }

}
