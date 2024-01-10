<?php

namespace App\Providers;

use App\Models\Posts;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class PostProvider extends ServiceProvider
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
        $recent_post =  null;
        if (Cache::has('recent_post'))
        {
            $recent_post = Cache::get('recent_post');
        } else {
            $recent_post = Posts::where('is_active',1)->latest()->take(4)->get();
            Cache::set('recent_post',$recent_post);
        }
        view()->composer(['block.recent_post','footer'],function ($view) use ($recent_post){
            $view->with('recent_post', $recent_post);
        });
    }
}
