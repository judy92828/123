<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class AboutController extends CommonController
{
    //首页
    public function index()
    {
        $info=DB::table('system')->select('about','contact','follow')->first();
        //网站信息
        $title='关于我们';
        return view('home.about.index',compact('info','title'));
    }
}
