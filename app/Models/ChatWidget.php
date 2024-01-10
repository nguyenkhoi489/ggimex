<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatWidget extends Model
{
    use HasFactory;
    protected $table = 'chatwidget';

    protected $fillable = [
        'title',
        'link',
        'thumb',
        'is_active'
    ];
}
