<?php


namespace App\Repositories;


use App\Models\Address;
use App\Repositories\Interfaces\AddressRepositoryInterface;

class AddressRepository implements AddressRepositoryInterface
{
    private $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }


    public function create($street,$house,$country,$region,$city)
    {
        $address = new Address();
        $address->street_name = $street;
        $address->house_number = $house;
        $address->country_id = $country;
        $address->region_id = $region;
        $address->city_id = $city;
        $address->save();
        return $address;
    }

    public function getOne($id)
    {
        return $this->address->find($id);
    }

    public function getAll()
    {
        return $this->address::all();

    }




}
