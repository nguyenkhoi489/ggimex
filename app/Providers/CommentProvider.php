<?php

namespace App\Providers;

use App\Models\Comments;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CommentProvider extends ServiceProvider
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
        $comment = null;
        if (Cache::has('comment'))
        {
            $comment = Cache::get('comment');
        } else
        {
            $comment = Comments::select('posts.title as post_title','posts.slug as post_slug','comment.*')
                ->where('comment.type','Post')
                ->where('comment.is_active','1')
                ->join('posts',function ($join){
                    $join->on('posts.id','=','comment.product_id');
                })
                ->take(5)->get();
            Cache::set('comment',$comment);
        }
        view()->composer(["block.recent_comment","block.comment"],function ($view) use ($comment){
           $view->with('comments',$comment);
        });
    }
}
