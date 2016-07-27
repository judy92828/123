<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Model\Article;
use App\Http\Controllers\Model\Category;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class WelfareController extends CommonController
{
    //健康公益首页
    public function index()
    {
        //推荐图
        $flagthumb=Article::where('status','2')->where('category_id',14)->where('recommend',1)->orderBy('id','desc')->whereNotNull('thumbnail')->take(5)->get();
        //最新数据（2条）
        $twodata=Article::where('status','2')->where('category_id',14)->orderBy('id','desc')->offset(0)->limit(2)->get();
        //最新数据（3条）
        $threedata=Article::where('status','2')->where('category_id',14)->orderBy('id','desc')->offset(2)->limit(3)->get();

        //健康之旅
        $jkdata=Article::where('status','2')->where('category_id',15)->orderBy('id','desc')->offset(0)->limit(4)->get();

        //健康故事
        $ygdata=Article::where('status','2')->where('category_id',16)->orderBy('id','desc')->offset(0)->limit(5)->get();
        //网站信息
        $title='健康公益';
        return view('home.welfare.index',compact('flagthumb','twodata','threedata','jkdata','ygdata','title'));
    }

    //栏目列表页面
    public function lists($title)
    {
        //数据分页
        $articles=Article::where('status','2')->where('category_id',$title)->orderBy('id','desc')->paginate(20);
        $cat=Category::find($title);
        return view('home.lists',compact('articles','cat'));


    }
 
    //详细页面
    public function show($id)
    {
        $info=Article::find($id);
        DB::table('articles')->where('id',$id)->increment('views');
        $cat=Category::find($info->category_id);
        $xgdata=Article::where('status','2')->where('id','!=',$id)->where('category_id',$info->category_id)->orderBy('id','desc')->take(4)->get();
        return view('home.show',compact('info','xgdata','cat'));
    }
}
