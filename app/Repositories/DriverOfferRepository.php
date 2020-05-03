<?php


namespace App\Repositories;



use App\Models\DriverOffer;
use App\Repositories\Interfaces\DriverOfferRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class DriverOfferRepository implements DriverOfferRepositoryInterface
{

    protected $driverOffer;
    private const ACTIVE_ORDER = 1;
    private const ACCEPTED_OFFER = 2;

    public function __construct(DriverOffer $driverOffer)
    {
        $this->driverOffer = $driverOffer;
    }



    public function filterDriverOffers($title, $country_id ,$region_id, $city_id,$weight,$capacity,$type): LengthAwarePaginator
    {

        $weight=(int)$weight;
        $capacity = (int)$capacity;

        return $this->driverOffer::with('country','region','city','types')
            ->where('status_id','=',self::ACTIVE_ORDER)
            ->when($country_id,function ($query,$country_id) {
                return $query->where('country_id','=',$country_id);
            })
            ->when($region_id,function ($query,$region_id) {
                return $query->where('region_id','=',$region_id);
            })->when($city_id,function ($query,$city_id) {
                return $query->where('city_id','=',$city_id);
            })->when($title,function ($query,$title) {
                return $query->where('title','LIKE','%'.$title.'%');
            })->when($weight,function ($query,$weight)
            {
                return $query->where('weight','>=',$weight);
            })->when($capacity,function ($query,$capacity)
            {
                return $query->where('capacity','>=',$capacity);
            })->when($type,function ($query,$type)
            {
                return $query->whereHas('types',function ($query) use ($type)
                {
                    $query->where('type_id',$type);
                });
            })
            ->orderBy('created_at','DESC')
            ->leftJoin('driver_cars','driver_car_id','=','driver_cars.car_id')
            ->with('carType')
            ->paginate(9)
            ->appends(request()->query());
    }

    public function acceptedOffer($driverOfferId)
    {

        $this->driverOffer = $this->driverOffer->find($driverOfferId);
        $this->driverOffer->status_id = self::ACCEPTED_OFFER;
        $this->driverOffer->save();

    }

    public function createOffer(Request $request)
    {
        $driverOffer = new DriverOffer();
        $driverOffer->title = $request->nameOfOrder;
        $driverOffer->description = $request->description;
        $driverOffer->country_id = $request->country;
        $driverOffer->region_id = $request->region;
        $driverOffer->city_id = $request->city;
        $driverOffer->price_per_km = $request->price_per_km;
        $driverOffer->capacity = $request->capacity;
        $driverOffer->weight = $request->weight;
        $driverOffer->driver_id = $request->driver_id;
        $driverOffer->driver_car_id = $request->driverCar;
        $driverOffer->status_id = self::ACTIVE_ORDER;
        if($driverOffer->save()) {
            $driverOffer->types()->sync($request->types);
            return true;
        }else
        {
            return  false;
        }

    }
    public function deleteDriverOffer(int $id)
    {
        DriverOffer::destroy($id);
    }
}
