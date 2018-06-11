<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded=[];
//بررسی کننده محتوایی عضو ناظر محتوایی حلقه
    public function nazer()
    {
        return $this->belongsTo(User::class);
    }
//یادداشت نویس
    public function user()
    {
        return $this->belongsTo(User::class);
    }
//ارزیاب شکلی که در ابتدا به هر کاربر نسبت داده شده است.
    public function arzyab()
    {
        return $this->belongsTo(User::class);
    }
//سوژه ای که هر یادداشت به آن تعلق دارد
    public function suzhe()
    {
        return $this->belongsTo(Suzhe::class);
    }

/**انتساب ناظر محتوایی به یادداشت با توجه به حلقه ها */

    public function choose_nazer()
    {
        return User::role('ozve_halghe')->with(['halghe'=>function($query){

        }])->get()->pluck('name','id');
      // dd(User::role('ozve_halghe')->get()->pluck('name','id'));
    }


}//end of class