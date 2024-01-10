<?php

namespace App\Providers;

use App\Models\Slider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class SliderProviders extends ServiceProvider
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
        //
        $slider = null;
        if (Cache::has('slider'))
        {
            $slider = Cache::get('slider');
        } else
        {
            $slider = Slider::where('is_active',1)->orderby('sort_by','asc')->get();
            Cache::set('slider',$slider);
        }
        view()->composer('block.slider',function ($view) use ($slider){
            $view->with('sliders', $slider);
        });
    }
}
