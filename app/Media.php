<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table='media';
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //هر رسانه میتواند شامل چندین یادداشت باشد
    public function notes()
    {
        return $this->belongsToMany(Note::class,'notes_media');
    }
}
