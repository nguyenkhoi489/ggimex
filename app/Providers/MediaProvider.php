<?php

namespace App\Providers;

use App\Http\Controllers\admin\MediaController;
use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class MediaProvider extends ServiceProvider
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
    public function boot(MediaController $mediaController)
    {
//        view()->composer('admin.footer',function ($view) use ($mediaController){
//           $view->with('files',$mediaController->showAllMedia());
//        });
        view()->composer('admin.copyright',function ($view) {
            $view->with('brand',Setting::where('id',1)->select('title')->first());
        });
        $favicon = null;
        if (Cache::has('favicon'))
        {
            $favicon = Cache::get('favicon');
        } else
        {
            $favicon = Setting::where('id',1)->select('favicon')->first();
            Cache::set('favicon',$favicon);
        }
        view()->composer('header',function ($view) use ($favicon) {
            $view->with('favicon',$favicon);
        });
        $logo  = null;
        if (Cache::has('logo'))
        {
            $logo = Cache::get('logo');
        } else
        {
            $logo = Setting::where('id',1)->select('logo')->first();
            Cache::set('logo',$logo);
        }
        view()->composer(['block.nav','admin.user.login','admin.sidebar'],function ($view){
            $view->with('logo',Setting::where('id',1)->select('logo')->first());
        });
    }
}
