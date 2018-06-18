<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded=[];

    public function getUserName(){
        return $this->belongsTo(User::class,'sender_id');
    }
}
