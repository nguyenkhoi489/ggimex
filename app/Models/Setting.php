<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'setting';

    protected $fillable = [
        'title',
        'meta',
        'keyword',
        'logo',
        'favicon',
        'google_index',
        'status',
        'content',
        'address',
        'phone',
        'email',
        'whatapps'
    ];
    public function run()
    {
        Setting::factory()
            ->create();
    }
}
