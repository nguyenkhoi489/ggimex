<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\Counter;
use App\Models\Posts;
use App\Models\Product;
use App\Models\Social;
use App\Models\UserOnline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    public function index()
    {
        return view('admin.home',[
            'title' => 'Trang quản trị Website',
            'product' => Product::count(),
            'post' =>  Posts::count(),
            'contact' =>  Contacts::count(),
            'user_visited' => Counter::distinct()->count('ip_address'),
            'count' => json_encode(['count' => Counter::count(),'date' => Counter::countVisited()])
        ]);
    }
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }

}
