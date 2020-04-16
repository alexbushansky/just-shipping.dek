<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Address;


class CustomerOffer extends Model
{
    protected $dates=['date_from','date_to'];


    public function addressFrom()
    {
        return $this->belongsTo(Address::class,'address_from_id');
    }


    public function addressTo()
    {
        return $this->belongsTo(Address::class,'address_to_id');
    }

    public function cargoType()
    {
        return $this->belongsToMany(Type::class);
    }


    public function dialogs()
    {

        return $this->morphMany(\App\Models\Dialog::class,'offer');

    }

    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class,'customer_id');
    }
    public function driver()
    {
        return $this->belongsTo(\App\Models\Driver::class,'driver_id');
    }

    public function user()
    {
       return $this->customer->user();
    }

    public function fullAddressFrom()
    {
        return  $this->addressFrom()->with('country')
                            ->with('region')
                            ->with('city');

    }
    public function fullAddressTo()
    {
        return  $this->addressTo()->with('country')
                            ->with('region')
                            ->with('city');
    }





}
