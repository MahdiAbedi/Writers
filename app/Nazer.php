<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nazer extends Model
{
    #چون اسم جدول با اسم مدل یکی نیست دستی اسم جدول را وارد میکنیم
    protected $table='nazer_notes';
    protected $guarded=[];
}
