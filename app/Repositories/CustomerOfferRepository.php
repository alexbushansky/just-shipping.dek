<?php


namespace App\Repositories;

use App\Models\CustomerOffer;
use App\Models\CustomerOfferImage;
use App\Models\User;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Repositories\Interfaces\CustomerOfferRepositoryInterface;


class CustomerOfferRepository implements CustomerOfferRepositoryInterface
{

    private $customerOffer;
    private $address;
    private const ACTIVE_ORDER = 1;
    private const ACCEPTED_OFFER = 2;
    private const COMPLETED_OFFER = 3;



    public function __construct(CustomerOffer $customerOffer,AddressRepositoryInterface $address)
    {
        $this->customerOffer = $customerOffer;
        $this->address = $address;
    }

    public function getAllOffers($title,$countryFrom,$regionFrom,$cityFrom,$countryTo,$regionTo,$cityTo,
                                 $price,$capacity,$weight,$typeCargo)
    {
        $weight = (int)$weight;
        $capacity = (int)$capacity;
        $price = (int)$price;
        return $this->customerOffer::with('cargoType', 'fullAddressFrom', 'fullAddressTo')
            ->when($weight, function ($query, $weight) {
                return $query->where('weight', '>=', $weight);
            })
            ->when($title, function ($query, $title) {
                return $query->where('title', 'LIKE', '%' . $title . '%');
            })
            ->when($capacity, function ($query, $capacity) {
                return $query->where('capacity', '>=', $capacity);
            })
            ->when($price, function ($query, $price) {
                return $query->where('price_per_km', '>=', $price);
            })
            ->when($typeCargo, function ($query, $typeCargo) {
                return $query->whereHas('cargoType', function ($query) use ($typeCargo) {
                    $query->where('type_id', $typeCargo);
                });
            })
            ->when($countryFrom, function ($query, $countryFrom) {
                return $query->whereHas('fullAddressFrom', function ($query) use ($countryFrom) {
                    $query->where('country_id', $countryFrom);
                });

            })
            ->when($regionFrom, function ($query, $regionFrom) {
                return $query->whereHas('fullAddressFrom', function ($query) use ($regionFrom) {
                    $query->where('region_id', $regionFrom);
                });

            })
            ->when($cityFrom, function ($query, $cityFrom) {
                return $query->whereHas('fullAddressFrom', function ($query) use ($cityFrom) {
                    $query->where('city_id', $cityFrom);
                });

            })
            ->when($countryTo, function ($query, $countryTo) {
                return $query->whereHas('fullAddressTo', function ($query) use ($countryTo) {
                    $query->where('country_id', $countryTo);
                });

            })
            ->when($regionTo, function ($query, $regionTo) {
                return $query->whereHas('fullAddressTo', function ($query) use ($regionTo) {
                    $query->where('region_id', $regionTo);
                });

            })
            ->when($cityTo, function ($query, $cityTo) {
                return $query->whereHas('fullAddressTo', function ($query) use ($cityTo) {
                    $query->where('city_id', $cityTo);
                });

            })
            ->where('status_id', '=', self::ACTIVE_ORDER)
            ->orderBy('created_at', 'DESC')
            ->paginate(9)
            ->appends(request()->query());

    }

    public function createOffer($nameOfOrder,$description,$addressFirst,$addressSecond,$weight,$pricePerKm,
                                $dateFinish,$customerId,$types,$photos,$addressFrom,$addressTo,$capacity)
    {

            $this->customerOffer->title = $nameOfOrder;
            $this->customerOffer->description = $description;
            $this->customerOffer->address_from_id = $addressFirst;
            $this->customerOffer->address_to_id = $addressSecond;
            $this->customerOffer->weight= $weight;
            $this->customerOffer->price_per_km= $pricePerKm;
            $this->customerOffer->date_start= date("Y-m-d");
            $this->customerOffer->date_finish= $dateFinish;
            $this->customerOffer->status_id= self::ACTIVE_ORDER;
            $this->customerOffer->customer_id= $customerId;
            $this->customerOffer->gallery = json_encode($photos);
            $this->customerOffer->lat_lng_from = $addressFrom;
            $this->customerOffer->lat_lng_to = $addressTo;
            $this->customerOffer->capacity = $capacity;



       if( $this->customerOffer->save())
       {
           $this->customerOffer->cargoType()->sync($types);
            return true;
       }
        return false;

    }

    public function acceptedOffer($customerOfferId, $driverId)
    {
            $this->customerOffer = $this->customerOffer->find($customerOfferId);

            $this->customerOffer->status_id =self::ACCEPTED_OFFER;
            $this->customerOffer->driver_id =$driverId;


            if($this->customerOffer->save())
            {
                return $this->customerOffer;
            }

        throw new \Exception('changed error');
    }

    public function completeOffer($id)
    {
        $order = CustomerOffer::find($id);
        if($order->status_id = self::ACCEPTED_OFFER) {
            $order->status_id = self::COMPLETED_OFFER;
            return $order->save();
        }
        {
            return false;
        }

    }

    public function showCompletedDriverOrders($driver)
    {
            $orders = CustomerOffer::where('driver_id','=',$driver->id)
                ->with('fullAddressFrom')
                ->with('fullAddressTo')
                ->with('customer')
                ->where('status_id', '=', self::COMPLETED_OFFER)
                ->orderBy('updated_at', 'desc')
                ->get();
            return $orders;
    }

    public function showCompletedCustomerOrders($customer)
    {
        $orders = CustomerOffer::where('customer_id','=',$customer->id)
            ->with('fullAddressFrom')
            ->with('fullAddressTo')
            ->with('driver')
            ->where('status_id', '=', self::COMPLETED_OFFER)
            ->orderBy('updated_at', 'desc')
            ->get();
        return $orders;
    }

    public function getCompletedOrder(int $id)
    {
        return CustomerOffer::find($id);
    }


}
