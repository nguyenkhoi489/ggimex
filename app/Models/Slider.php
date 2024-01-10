<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'slider';

    protected $fillable = [
        'title',
        'thumb',
        'type',
        'text',
        'subtext',
        'sort_by',
        'is_active',
        'text_position'
    ];
}
