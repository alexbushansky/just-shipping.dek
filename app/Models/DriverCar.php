<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverCar extends Model
{
    public $timestamps = false;

    public function driverUser()
    {
        return $this->hasOne(Driver::class);
    }

    public function carType()
    {
        return $this->hasOne(CarType::class,'type_of_car');
    }
}
