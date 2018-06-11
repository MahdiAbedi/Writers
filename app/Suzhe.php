<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suzhe extends Model
{
    protected $guarded=[];
    public function halghe()
    {
        return $this->belongsTo(Halghe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
