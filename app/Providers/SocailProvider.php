<?php

namespace App\Providers;

use App\Models\Social;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class SocailProvider extends ServiceProvider
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
        $social = null;
        if (Cache::has('social'))
        {
            $social = Cache::get('social');
        } else {
            $social = Social::where('is_active',1)->get();
            Cache::set('social',$social);
        }
        view()->composer('footer',function ($view) use ($social){
           $view->with('socials',$social);
        });
    }
}
