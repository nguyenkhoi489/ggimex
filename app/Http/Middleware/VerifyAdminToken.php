<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class VerifyAdminToken
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
        $token = $request->header('Authentication');
        $user = PersonalAccessToken::where('token',$token)->first();
        if (! $user) {
            return response()->json(['success' => false, 'messsage' => 'Vui lòng đăng nhập lại']);
        }
        $admin = User::find($user->tokenable_id);
        if (!$admin)
        {
            return response()->json(['success' => false, 'messsage' => 'Vui lòng đăng nhập lại']);
        }
        if (strtotime($user->expires_at) < time()) {
            return response()->json(['success' => false, 'messsage' => 'Vui lòng đăng nhập lại']);
        }
        return $next($request);
    }
}
