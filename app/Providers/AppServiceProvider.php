<?php

namespace App\Providers;

use App\Note;
use App\User;
use App\Suzhe;
use App\Message;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);

        //نمایش آخرین پیامهای سیستمی
        view()->composer('layouts.topmenu', function ($view) {
            $view->with('sysMsges', Message::whereRaw('sender_id=0 and status="جدید" and reciever_id='.auth()->id())->latest()->get());
            });
        //نمایش آخرین پیام های دریافتی از سایر کاربران
        view()->composer('layouts.topmenu', function ($view) {
            $view->with('messages', Message::whereRaw('sender_id !=0 and status="جدید" and reciever_id='.auth()->id())->latest()->get());
            });
#################################################################################################
#################################################################################################
            //نمایش اطلاعات در کنار ساید بار مثل تعداد سوژه های جدید و ...
            view()->composer('layouts.sidebar', function ($view) {
                $data=[];
                //کاربر عضو چه حلقه هایی هست
                
                    $halghes=auth()->user()->halghe;
                    foreach($halghes as $halghe)
                    { 
                        $data[]=$halghe->id;  
                    }
                
                $suzhes_count=Suzhe::where(function($query) use ($data){
                   
                    /**
                     * اگر کاربر مدیر یا عضو ستاد شبکه نبود فقط بتواند سوژه های حلقه خود را ببیند
                     */
     
                       // dd($data);
                        //بغییر از مدیر و ستاد شبکه بقیه فقط سوژه های تایید شده را مشاهده میکنند
                        $query->where('status','منتشر شده');
                        //فقط سوژه هایی که ظرفیت خالی دارند به کاربران نمایش داده میشود
                       //i used whereRaw() to compare two fields
                        $query->whereRaw('user_limit > choosed_users');
                        //یادداشت نویس قبل از انقضای سوژه میتواند آنرا انتخاب کند
                        $query->whereRaw('expire_date >date(now())');
                        //کاربران فقط سوژه های حلقه خود را مشاهده میکنند
                        if (!auth()->user()->hasRole(['modir'])){
                            $query->whereIn('halghe_id', $data);
                        }
                        

                    
                })->count();

                $nazer_count=Note::where(function($query){
                    $query->where('nazer_id',auth()->id());
                    $query->whereIn('status',['ارزیابی مجدد','ارزیابی محتوایی']);
                })->count();
                
                $arzyabi_count=Note::where(function($query){
                    $query->where('arzyab_id',auth()->id());
                    $query->where('status','ارزیابی شکلی');
                })->count();
                
                $nazer_wating=Note::where(function($query) use ($data){
                    $query->whereNull('nazer_id');
                    if (!auth()->user()->hasRole(['modir'])){
                        $query->whereIn('halghe_id', $data);
                    }
                })->count();

                $note_started=Note::where(function($query) use ($data){
                    $query->where('status','اعلام آمادگی');
                    if (!auth()->user()->hasRole(['modir|modir_halghe'])){
                        $query->whereIn('halghe_id', $data);
                        $query->where('user_id',auth()->id());
                    }
                })->count();

                $user_count=User::count();

                $message_count=Message::whereRaw('status="جدید" and reciever_id='.auth()->id())->count();

                $view->with(compact('message_count','user_count','suzhes_count','nazer_count','arzyabi_count','nazer_wating','note_started'));
                });

#################################################################################################
#################################################################################################
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
