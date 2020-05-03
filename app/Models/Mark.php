<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $fillable = [
        'order_id', 'user_id', 'type_id','mark'
    ];
}
