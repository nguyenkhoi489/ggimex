<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $fillable = [
        'title',
        'slug',
        'type',
        'parent_id',
        'table_id',
        'sort_by',
        'is_active'
    ];
}
