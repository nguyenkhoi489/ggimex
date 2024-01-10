<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $table = 'seo';

    protected $fillable = [
        'title',
        'description',
        'canonical',
        'slug',
        'thumb',
        'posts_id',
        'google_index',
        'type'
    ];
    public function getModel() {
        switch ($this->type) {
            case 'PostCategories':
                return PostCategories::where('id', $this->posts_id)->first();
            case 'Posts':
                return Posts::select('posts.*','post_categories.title as categories_title','post_categories.slug as categories_slug','users.fullname')
                    ->where('posts.id', $this->posts_id)
                    ->join('post_categories',function ($join){
                        $join->on('post_categories.id','=','posts.categories_id');
                    })
                    ->join('users',function ($join){
                        $join->on('users.id','=','posts.author_id');
                    })
                    ->first();
            case 'ProductCategories':
                return ProductCategories::where('id', $this->posts_id)->first();
            case 'Product':
                return Product::where('id', $this->posts_id)->first();
            case 'Pages':
                return Pages::where('id', $this->posts_id)->first();
            default:
                return null;
        }
    }
}
