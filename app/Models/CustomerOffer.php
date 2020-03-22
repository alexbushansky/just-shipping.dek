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



}
