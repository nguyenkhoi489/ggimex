<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Sanctum\PersonalAccessToken;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.user.login', ['title' => 'Đăng nhập hệ thống']);
    }

    public function store(UserRequest $userRequest)
    {
        $userRequest->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['username' => $userRequest->username, 'password' => $userRequest->password], $userRequest->remember)) {
            if (Auth::user()->is_active === 0) {
                Auth::logout();
                return back()->withErrors('Tài khoản đã bị khóa.');
            }
            $token = Auth::user()->createToken('access_token');
            $time = now()->addDays(1)->getTimestamp();
            $token->accessToken->expires_at = $time;
            $token->accessToken->save();

            $cookie = Cookie::make('access_token',$token->accessToken->token,$time);

            return redirect()->route('dashboard')->withCookie($cookie);
        }
        return back()->withErrors('Thông tin đăng nhập không hợp lệ');
    }
}
