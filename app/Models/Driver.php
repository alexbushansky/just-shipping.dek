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
}
