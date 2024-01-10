<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOnline extends Model
{
    use HasFactory;
    protected $table = 'user_online';
    protected $fillable = [
        'session_id',
        'last_visisted'
    ];
    public $timestamps = false;
    protected $primaryKey = 'session_id';

}
