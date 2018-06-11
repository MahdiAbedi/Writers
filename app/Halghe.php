<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Halghe extends Model
{
    public function suzhes()
    {
        return $this->hasOne(Suzhe::class);
    }

    public function user()
    {
       // return $this->belongsToMany('App\User','halghe_user','halghe_id','user_id');
        return $this->belongsToMany(User::class);
    }

    public static function getUserHalghes()
    {
        $suzhes=Halghe::where(function($query) 
            {
                $data=[];
                /**
                 * اگر کاربر مدیر یا عضو ستاد شبکه نبود فقط بتواند یادداشتهای حلقه خود را ببیند
                 */
                if (!auth()->user()->hasRole(['modir']))
                 {
                    $halghes=auth()->user()->halghe;
                    foreach($halghes as $halghe)
                    { 
                        $data[]=$halghe->id;  
                    }
                    //بغییر از مدیر و ستاد شبکه بقیه فقط سوژه های تایید شده را مشاهده میکنند
                    //$query->where('status','منتشر شده');
                    $query->whereIn('id', $data);
                    return $query;
                }
    
            });
            
        $suzhes=$suzhes->get();
       // dd($suzhes);
        return $suzhes;
    }
}
