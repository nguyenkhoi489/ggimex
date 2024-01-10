<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = [
        'name',
        'email',
        'rating',
        'message',
        'ip_address',
        'product_id',
        'type'
    ];
}
