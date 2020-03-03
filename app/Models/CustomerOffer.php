<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CustomerOffer extends Model
{
    protected $dates=['date_from','date_to'];




    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class);
    }

    public function region()
    {
        return $this->belongsTo(\App\Models\Region::class);
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class);
    }



}
