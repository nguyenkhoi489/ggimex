<?php

namespace App\Providers;

use App\Models\ChatWidget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ChatProvider extends ServiceProvider
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
        $chatwidget = null;

        if (Cache::has('chat'))
        {
            $chatwidget = Cache::get('chat');
        } else
        {
            $chatwidget = ChatWidget::where('is_active',1)->get();
            Cache::set('chat',$chatwidget);
        }

        view()->composer('footer',function ($view) use ($chatwidget){
            $view->with('chats',$chatwidget);
        });
    }
}
