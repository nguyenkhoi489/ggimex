<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Counter extends Model
{
    use HasFactory;
    protected $table = 'counter';
    protected $fillable = [
        'ip_address',
        'user_again'
    ];
    public static function countVisited($year = null, $month = null)
    {
        $now = now();

        return DB::table('counter')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', $now->startOfMonth())
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();
    }
}
