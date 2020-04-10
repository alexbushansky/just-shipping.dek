<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'user_id'
    ];

    public function driverOffers()
    {
        return $this->hasMany(\App\Models\DriverOffer::class);
    }
    public function driverCar()
    {
        return$this->hasMany(DriverCar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
