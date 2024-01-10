<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategories extends Model
{
    use HasFactory;
    protected $table = 'post_categories';
    protected $fillable = [
        'title',
        'description',
        'slug',
        'thumb',
        'is_active'
    ];

}