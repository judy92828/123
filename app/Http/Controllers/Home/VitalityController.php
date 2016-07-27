<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Model\Article;
use App\Http\Controllers\Model\Category;
use App\Http\Controllers\Model\Links;
use App\Http\Controllers\Model\Videos;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class VitalityController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }
    //活力四川首页
    public function index()
    {
        //吃喝玩乐推荐图
        $flagthumb=Article::where('status','2')->where('category_id',2)->where('recommend',1)->whereNotNull('thumbnail')->take(5)->get();
        //最新数据（2条）
        $twodata=Article::where('status','2')->where('category_id',2)->orderBy('id','desc')->offset(0)->limit(2)->get();
        //最新数据（3条）
        $threedata=Article::where('status','2')->where('category_id',2)->orderBy('id','desc')->offset(2)->limit(3)->get();

        //健康之旅
        $jkdata=Article::where('status','2')->where('category_id',3)->orderBy('id','desc')->offset(0)->limit(4)->get();

        //阳光校园

        $ygdata=Article::where('status','2')->where('category_id',4)->orderBy('id','desc')->offset(0)->limit(5)->get();

        //地方频道
        $channel=Links::where('status','1')->where('type','1')->get();

        //网站信息
        $title='活力四川';
        return view('home.vitality.index',compact('flagthumb','twodata','threedata','jkdata','ygdata','channel','title'));
    }

    //活力四川栏目列表页面
    public function lists($title)
    {
        //数据分页
        $articles=Article::where('status','2')->where('category_id',$title)->paginate(20);
        if($articles->count()!=0){
            $cat=Category::find($articles[0]->category_id);
        }else{
            $cat=null;
        }
        return view('home.lists',compact('articles','title','cat'));
    }

    //活力四川详细页面
    public function show($id)
    {
        $info=Article::find($id);
        //阅读量
        DB::table('articles')->where('id',$id)->increment('views');
        $cat=Category::find($info->category_id);
        $xgdata=Article::where('status','2')->where('id','!=',$id)->where('category_id',$info->category_id)->orderBy('id','desc')->take(4)->get();
        return view('home.show',compact('info','xgdata','cat'));
        
    }
}
