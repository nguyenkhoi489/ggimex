<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedirectRoles extends Model
{
    use HasFactory;
    protected $table = 'redirect_roles';

    protected $fillable = [
        'old_url',
        'new_url'
    ];
}
