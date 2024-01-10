<?php

namespace App\Providers;

use App\Models\Menus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class MenusProvider extends ServiceProvider
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
        $menu = null;
        if (Cache::has('menus'))
        {
            $menu = Cache::get('menus');
        } else
        {
            $menu = Menus::select('title','slug','id','type','parent_id')->where('is_active',1)->orderby('sort_by','asc')->get();
            Cache::set('menus', $menu);
        }
        view()->composer("block.nav",function ($view) use ($menu) {
           $view->with('menus',$menu);
        });
    }
}
