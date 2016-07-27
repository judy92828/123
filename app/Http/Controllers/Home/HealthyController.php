<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;

use App\Http\Requests;

class HealthyController extends CommonController
{
    //首页
    public function index()
    {
        //网站信息
        $title='健康教育';
        return view('home.healthy.index',compact('title'));
    }
}
