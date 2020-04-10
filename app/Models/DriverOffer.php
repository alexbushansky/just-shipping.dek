<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverOffer extends Model
{
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

    public function driver()
    {
        return $this->belongsTo(\App\Models\Driver::class);
    }


    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    public function carType()
    {
        return $this->belongsTo(\App\Models\CarType::class,'type_of_car');
    }

    public function dialogs()
    {

        return $this->morphMany(\App\Models\Dialog::class,'dialogable');

    }


}
