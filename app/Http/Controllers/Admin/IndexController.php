<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Model\Agency;
use App\Http\Controllers\Model\Article;
use App\Http\Controllers\Model\Links;
use App\Http\Controllers\Model\Videos;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class IndexController extends CommonController
{
    //后台首页
    public function index()
    {
        //获取最新的文章
        $article=Article::orderBy("id","desc")->take(8)->get();
        //文章总数量
        $arnum=Article::count();
        //视频总数量
        $vinum=Videos::count();
        //合作机构总数量
        $agnum=Agency::count();
        //地方频道总数量
        $linum=Links::where('type','1')->count();

        return view('admin.index',compact('article','arnum','vinum','agnum','linum','user'));
    }
}
