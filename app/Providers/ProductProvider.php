<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\ProductTags;
use Illuminate\Support\ServiceProvider;

class ProductProvider extends ServiceProvider
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
        view()->composer("block.product",function ($view){
           $view->with('products',Product::select('product.*', 'prefix.value')
               ->where('product.is_active', 1)
               ->join('prefix', function ($join) {
                   $join->on('prefix.id', '=', 'product.prefix_id');
               })
               ->take(8)->get());
        });
        view()->composer("block.canvas",function ($view){
            $view->with('category',ProductCategories::select('id','title','slug')->where('is_active',1)->orderby('title','asc')->get());
            $view->with('tags',ProductTags::select('id','title')->orderby('title','asc')->get());
        });
    }
}
