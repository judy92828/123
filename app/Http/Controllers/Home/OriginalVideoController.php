<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Model\Issue;
use App\Http\Controllers\Model\Videos;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class OriginalVideoController extends CommonController
{
    //原创视频首页
    public function index()
    {
        $video1=Videos::where('category_id',6)->where('status',"2")->orderBy('id','desc')->take(3)->get();
        $video2=Videos::where('category_id',7)->where('status',"2")->orderBy('id','desc')->take(3)->get();
        $video3=Videos::where('category_id',8)->where('status',"2")->orderBy('id','desc')->take(3)->get();
        //网站信息
        $title='原创视频';
        return view('home.originalvideo.index',compact("video1","video2","video3",'title'));
    }

    //显示单个视频页
    public function showvideo($id,$issue=null){
        $arr= array(6,7,8);
        if($issue==null){
            $info=DB::table('videos')->join("issues","videos.id","=","issues.video_id")->where("videos.id",$id)->first();
        }else{
            $info=DB::table('videos')->join("issues","videos.id","=","issues.video_id")->where("videos.id",$id)->where("issues.id",$issue)->first();
        }
        //获取期数
        $issues=Issue::where('video_id',$id)->get();
        if($info==null){
            $info=Videos::where("id",$id)->first();
        }
       foreach ($arr as $key=>$value){
            if ($value === $info->category_id) {
                unset($arr[$key]);
            }
        }
        $Xgvideos=Videos::whereIn('category_id',$arr)->take(4)->get();
       //增加阅读量
        DB::table('videos')->where('id',$id)->increment('views');
        
        $title= $info->title;
        return view('home.originalvideo.videosdetail',compact("info","Xgvideos","issues","title",'id'));
    }


    //视频列表页
    public function showlist($title){
        $videos=Videos::where("category_id",$title)->paginate(10);
        return view("home.originalvideo.videolist",compact("videos","title"));
    }
}
