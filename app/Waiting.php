<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waiting extends Model
{
    //protected $table='notes_media';
    //برای اینکه بتوانم شناسه کاربر رو هم بدست بیارم
    //تا هر رابط فقط بتونه یادداشتهای مربوط به خودش رو ببینه از ویو استفاده کردم
    
    protected $table='notes_media_user';
    protected $guarded=[];

    public function note()
    {
        return $this->belongsTo('App\Note');
    }

    public function media()
    {
       return $this->belongsTo('App\Media');
    }
}
