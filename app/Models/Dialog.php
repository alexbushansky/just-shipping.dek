<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerOffer;

class Dialog extends Model
{

    public function customerOffer()
    {
        //return $this->morphMany(CustomerOffer::class, 'dialogable');

        return $this->belongsTo(CustomerOffer::class,'offer_id');
    }

    public function driverOffer()
    {
        return $this->belongsTo(DriverOffer::class,'offer_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function messages()
    {

        return $this->hasMany(\App\Models\DialogMessage::class)->orderBy('created_at','ASC')->get(['dialog_id','user_id','message_text',
            'created_at']);
    }

    public function allMessage()
    {
        return $this->belongsTo(\App\Models\DialogMessage::class)->orderBy('created_at','ASC')->get(['dialog_id','user_id','message_text',
            'created_at']);
    }

    public function getDriver($id)
    {
        return User::find($id)->driver;
    }


    public function recipient()
    {
        return $this->belongsTo(User::class,'recipient_id');
    }





}
