<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTags extends Model
{
    use HasFactory;

    protected $table = 'product_tags';

    protected $fillable = [
        'title',
        'slug',
        'product_id',
        'is_active'
    ];
}
