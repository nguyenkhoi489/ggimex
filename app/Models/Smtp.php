<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smtp extends Model
{
    use HasFactory;

    protected $table = 'smtp';

    protected $fillable = [
        'smtp_type',
        'host',
        'username',
        'password',
        'port',
        'type',
        'is_active'
    ];
}
