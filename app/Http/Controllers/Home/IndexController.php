<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Model\Article;
use App\Http\Controllers\Model\Banners;
use App\Http\Controllers\Model\Category;
use App\Http\Controllers\Model\Videos;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class IndexController extends CommonController
{
    //首页
    public function index()
    {
         //获取轮播图区域文章
        $articles=Banners::where("status",2)->OrderBy('id','desc')->take(5)->get();
        //时事要闻
        $bgnew=Article::where('category_id',17)->where('recommend',1)->orderBy('id','desc')->where('status',2)->first();
        $news=Article::where('category_id',17)->where('recommend',1)->orderBy('id','desc')->where('status',2)->take(4)->get();

        //大话健康
        $bghealth=Article::where('category_id',18)->where('recommend',1)->orderBy('id','desc')->where('status',2)->first();
        $health=Article::where('category_id',18)->where('recommend',1)->orderBy('id','desc')->where('status',2)->take(5)->get();

        //医师风采
        $ysdata=Article::where('category_id',10)->where('status',2)->orderBy('id','desc')->where('status','2')->take(4)->get();

        //健康访谈
        $hlinterview=Videos::where('category_id','11')->where('recommend',1)->orderBy('id','desc')->where('status',2)->take(2)->get();

        //健康公益
        $bgpublichealth=Article::whereIn('category_id',[14,15,16])->where('recommend',1)->orderBy('id','desc')->where('status',2)->first();

        $publichealth=Article::whereIn('category_id',[14,15,16])->where('recommend',1)->orderBy('id','desc')->where('status',2)->offset(1)->limit(3)->get();

        //活力四川
        $flagthumb=Article::where('category_id',2)->where('status','2')->orderBy('id','desc')->where('recommend',1)->take(3)->get();

        //健康之旅
        $jkdata=Article::where('category_id',3)->where('status','2')->orderBy('id','desc')->where('recommend',1)->take(3)->get();

        return view('home.index',compact('articles','bgnew','news','bgpublichealth','bghealth','health','ysdata','hlinterview','publichealth','flagthumb','jkdata'));

    }

    //列表页
    public function showlist($title){
        $articles=Article::where('category_id',$title)->paginate(10);
        $cat=Category::find($articles[0]->category_id);
        return view('home.lists',compact('articles',"title",'cat'));
    }

    //详情页
    public function show($id){
        $info=Article::find($id);
        //阅读量
        DB::table('articles')->where('id',$id)->increment('views');

        $cat=Category::find($info->category_id);
        $xgdata=Article::where('status','2')->where('id','!=',$id)->where('category_id',$info->category_id)->orderBy('id','desc')->take(4)->get();
        
        return view('home.show',compact('info','cat','xgdata'));
    }
}
