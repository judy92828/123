<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Model\ads;
use App\Http\Controllers\Model\Agency;
use App\Http\Controllers\Model\Article;
use App\Http\Controllers\Model\Links;
use App\Http\Controllers\Model\Seachs;
use App\Http\Controllers\Model\System;
use App\Http\Controllers\Model\Videos;
use Illuminate\Http\Request;
// 引入鉴权类
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;
//
use Qiniu\Storage\BucketManager;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;


class CommonController extends Controller
{

     public $accessKey = 'gh2Xv4xUstzHanM4NFkFMmy2Q1T2KbGKqkR0tm6D';
     public $secretKey = 'vT_2PQ_oAn9zVwTHqvgkzL8goJyF2uhbXSbE9MVz';
     public function __construct()
     {
            $controller = $this->getCurrentAction();
            $users = session('users');
            $status=null;

         //视频推荐
         $flagvideo=Videos::where('status','2')->where('recommend','1')->orderBy('id','desc')->take(2)->get();
         //热门文章
         $redarticle=Article::where('status','2')->whereNotIn('category_id',[9,10,11,12])->orderBy('views','desc')->take(10)->get();
         //友情链接
         $links=Links::where('status','1')->where('type','0')->orderBy('id','desc')->get();
         //合作机构
         $outfit=Agency::where('status','1')->orderBy('id','desc')->get();

         //系统设置
         $system=System::first();
         //页面顶部广告
         //   0 首页文字广告
         //   1 页面顶部广告
         //   2 首页中部广告
         //   3 页面右边广告
         //   4 详细页底部广告
         $advtext=ads::where('position_id','0')->where('status','2')->orderByRaw('rand()')->get();
         $arr=[
             'flagvideo'=>$flagvideo,
             'redarticle'=>$redarticle,
             'links'=>$links,
             'agency'=>$outfit,
             'system'=>$system,
             'advtext'=>$advtext
         ];
         view()->share('datas',$arr);
         view()->share('user',$users['name']);
         view()->share('uid',$users['id']);
         view()->share('controller',$controller['controller']);
         view()->share('action',$controller['method']);
         view()->share('status',$status);

         //用户登录
         $user=Session::get('users');
         view()->share('user',$user);
    }

    public function getdata($field){
        //系统设置
        $system=System::first();
        return $system[$field];
    }

    //上传图片
    public function uplode()
    {
        $auth = new Auth($this->accessKey, $this->secretKey);

        $file = Input::file('file_upload');
        if($file -> isValid()){
            // 要上传的空间
            $bucket = 'jiankangtai';
            // 生成上传 Token
            $token = $auth->uploadToken($bucket);
            
            $entension = $file -> getClientOriginalExtension(); //上传文件的后缀.
            $newName = date('YmdHis').mt_rand(100,999).'.'.$entension;
            // 上传到七牛后保存的文件名
            $key = $newName;

            // 初始化 UploadManager 对象并进行文件的上传
            $uploadMgr = new UploadManager();

            // 调用 UploadManager 的 putFile 方法进行文件的上传
            list($ret, $err) = $uploadMgr->putFile($token, $key, $file);
            $filepath="http://o9sccet84.bkt.clouddn.com/";

            if($err!=null){
                return $err;
            }else{
               return $filepath.$newName;
            }
        }

    }

    //删除服务器上相应图片资源
    public function deletefile($key){
        //初始化Auth状态
        $auth = new Auth($this->accessKey, $this->secretKey);
        //初始化BucketManager
        $bucketMgr = new BucketManager($auth);
        //你要测试的空间， 并且这个key在你空间中存在
        $bucket = 'jiankangtai';
        //删除$bucket 中的文件 $key
        $bucketMgr->delete($bucket, $key);
    }
    
    public function getCurrentAction()
    {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);
        $arr=explode('\\', $class);
        $controller=end($arr);
        return ['controller' => $controller, 'method' => $method];
    }

    //搜索功能
    public function seachs()
    {
        if($input=Input::all()){
            $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
            $k=($_GET['page']-1)*10+1;
            //查询文章
            DB::connection()->enableQueryLog();

            $data=Seachs::where('title','like','%'.$input["keywords"].'%')->orderBy('id','desc')->paginate(5);

            $keywords=$input['keywords'];

            return view('home.seachs.index',compact('data','keywords','k'));
        }else{
            return back();
        }
    }

    //新闻分类推荐处理
    public function news()
    {
        if($input=Input::all()){
            return category($input['id'])['parent_id'];
        }else{
            return '0';
        }
    }
}
