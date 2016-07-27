<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;

use App\Http\Requests;

class AuthorityController extends CommonController
{
    //首页
    public function index()
    {
        //网站信息
        $title='权威发布';
        return view('home.authority.index',compact('title'));
    }
}
