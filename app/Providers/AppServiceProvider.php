<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Message;

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
            $view->with('sysMsges', Message::where('sender_id',0)->latest()->get());
            });
        //نمایش آخرین پیام های دریافتی از سایر کاربران
        view()->composer('layouts.topmenu', function ($view) {
            $view->with('messages', Message::where('sender_id','!=',0)->latest()->get());
            });
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
