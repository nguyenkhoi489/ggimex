<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'thumb',
        'categories_id',
        'content',
        'is_active',
        'author_id'
    ];

    public function getView()
    {
        return 'post.single';
    }
}
