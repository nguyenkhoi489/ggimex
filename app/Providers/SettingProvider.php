<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\UserOnline;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class SettingProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $info = null;
        if (Cache::has('setting'))
        {
            $info = Cache::get('setting');
        } else {
            $info = Setting::select('title','address','phone','email','tax','iframe','google_index')->where('id',1)->first();
            Cache::set('setting',$info);
        }
        view()->composer(['main','pages.contact'],function ($view) use ($info)
        {
            $view->with('setting',$info);
        });
        view()->composer('admin.nav',function ($view){
            $view->with('user_online',UserOnline::count());
        });
    }
}
