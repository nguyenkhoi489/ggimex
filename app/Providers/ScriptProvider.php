<?php

namespace App\Providers;

use App\Models\Script;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ScriptProvider extends ServiceProvider
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
        $header = null;
        if (Cache::has('header_script')) {
            $header = Cache::get('header_script');
        } else {
            $header = Script::where('is_active', 1)->where('position', 0)->get();
            Cache::set('header_script', $header);
        }
        $body_tags = null;
        if (Cache::has('body_script')) {
            $body_tags = Cache::get('body_script');
        } else {
            $body_tags = Script::where('is_active', 1)->where('position', 1)->get();
            Cache::set('body_script', $body_tags);
        }
        $footer = null;
        if (Cache::has('footer_script')) {
            $footer = Cache::get('footer_script');
        } else {
            $footer = Script::where('is_active', 1)->where('position', 2)->get();
            Cache::set('$footer', $footer);
        }
        view()->composer('header',function ($view) use ($header) {
           $view->with('header_script',$header);
        });
        view()->composer('main',function ($view) use ($body_tags) {
            $view->with('body_tags',$body_tags);
        });
        view()->composer('footer',function ($view) use ($footer) {
            $view->with('footer_script',$footer);
        });
    }
}
