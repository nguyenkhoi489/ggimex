<?php

namespace App\Http\Middleware;

use App\Models\UserOnline;
use Closure;
use Illuminate\Http\Request;
use App\Models\Counter as UserCounter;
class Counter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $time = 60;

        $session_id = session()->getId();

        $visited = UserOnline::where('session_id', $session_id)->first();

        if ($visited) {
            $visited->last_visisted = time();
            $visited->save();
        } else {
            UserOnline::create(['session_id' => $session_id, 'last_visisted' => time()]);
        }

        UserOnline::whereRaw("UNIX_TIMESTAMP() - last_visisted > $time")->delete();


        $visited_count = [
            'ip_address' => $request->ip(),
            'user_again' => $_SERVER['HTTP_USER_AGENT']
        ];
        UserCounter::create($visited_count);
        return $next($request);
    }
}
