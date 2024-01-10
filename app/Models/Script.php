<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    use HasFactory;
    protected $table = 'script';
    protected $fillable = [
        'title',
        'widget_code',
        'position',
        'is_active'
    ];
}
