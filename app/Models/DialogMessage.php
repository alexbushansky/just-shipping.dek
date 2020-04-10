<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DialogMessage extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dialog()
    {
        return $this->belongsTo(Dialog::class);
    }
}
