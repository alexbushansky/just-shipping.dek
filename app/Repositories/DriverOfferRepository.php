<?php


namespace App\Repositories;



use App\Models\DriverOffer;
use App\Repositories\Interfaces\DriverOfferRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DriverOfferRepository implements DriverOfferRepositoryInterface
{

    protected $driverOffer;

    public function __construct(DriverOffer $driverOffer)
    {
        $this->driverOffer = $driverOffer;
    }



    public function filterDriverOffers($title, $country_id ,$region_id, $city_id): LengthAwarePaginator
    {

        return $this->driverOffer::with('country','region','city','carType')
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
            ->orderBy('created_at','DESC')
            ->paginate(9)
            ->appends(request()->query());
    }
}
