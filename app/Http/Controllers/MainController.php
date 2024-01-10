<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use App\Models\Seo;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    //
    public function index()
    {
        $data = null;
        if (Cache::has('home'))
        {
            $data = Cache::get('home');
        } else
        {
            $data = Pages::where('id',1)->first();
            Cache::set('home',$data);
        }
        $seo = null;
        if (Cache::has('seo_home'))
        {
            $seo = Cache::get('seo_home');
        } else {
            $seo = Seo::where('type','Pages')->where('posts_id',1)->first();
            Cache::set('seo_home',$seo);
        }

        return view('pages.home',[
            'title' => $seo->title,
            'className' => 'home',
            'seo' => $seo,
            'data' => json_decode($data->content)
        ]);
    }

}
