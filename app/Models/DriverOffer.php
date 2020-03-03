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
}
