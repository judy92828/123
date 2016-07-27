<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Model\Article;
use App\Http\Controllers\Model\Videos;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class DoctorController extends CommonController
{
    //首页
    public function index()
    {
        //医师风采
        $ysdata=Article::where('status','2')->where('category_id','10')->take(10)->get();
        //健康访谈
        $jkdata=Videos::where('status','2')->where('category_id','11')->take(2)->get();
        //专家说
        $zjdata=Videos::where('status','2')->where('category_id','12')->take(6)->get();
        $title='大医精诚';
        return view('home.doctor.index',compact('ysdata','jkdata','zjdata','title'));
    }
    
    //列表页面
    public function lists($title)
    {
        if($title==11||$title==12){
            //数据分页
            $lists=Videos::where('status','2')->where('category_id',$title)->paginate(20);
            return view('home.doctor.list',compact('lists','title'));
        }else{
            //数据分页
            $lists=Article::where('status','2')->where('category_id',$title)->paginate(20);
            return view('home.doctor.lists',compact('lists','title'));
        }
    }

    //详情页面
    public function show($title)
    {
        $info=Article::find($title);
        DB::table('articles')->where('id',$title)->increment('views');
        return view('home.doctor.shows',compact('info'));
    }
    //视频详情页面
    public function videoshow($id)
    {
        DB::table('videos')->where('id',$id)->increment('views');
//        $info = DB::table('videos')->join('issues','videos.id','=','issues.video_id')->where('videos.status','2')->where('issues.status','2')->where('videos.id',$id)->select('videos.id','videos.category_id','videos.type','videos.title','videos.summary','videos.thumbnail','videos.keywords','videos.source','videos.author','issues.url','videos.created_at')->first();
        $info=Videos::find($id);
        $title=$info->category_id;
        //随机查询
        $rand=Videos::where('status','2')->where('category_id','11')->orderByRaw('rand()')->get();
        return view('home.doctor.show',compact('info','rand','title'));
    }
}
