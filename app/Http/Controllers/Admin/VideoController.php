<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Model\Category;
use App\Http\Controllers\Model\Seachs;
use App\Http\Controllers\Model\Videos;
use Illuminate\Http\Request;
use App\Http\Controllers\Model\Issue;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class VideoController extends CommonController
{
    //视频列表
    public function index()
    {
        $cates=Category::where('type','=',1)->get();
        $data=Videos::orderBy('id','desc')->paginate(10);
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        return view('admin.video.index',compact('cates','data','k'));

    }

    //添加视频
    public function create()
    {
        $category=Category::where('type','=',1)->get();
        return view('admin.video.create')->with('categories',$category);
    }
    
    //添加提交过来的数据
    public function store()
    {
        if($input=Input::except('_token','file_upload')){
            $input['created_at']=date('Y-m-d H:i:s',time());
            $input['updated_at']=date('Y-m-d H:i:s',time());
            if($inid=DB::table('videos')->insertGetId($input)){
                $date=[
                    'title'=>$input['title'],
                    'type'=>1,
                    'id'=>$inid
                ];
                Seachs::create($date);
                return redirect('admin/video');
            }else{
                return back()->with('errors','保存失败');
            }
        }
    }

    //修改视频信息
    public function edit($id)
    {
        $categories =Category::where('type','=',1)->where('id','!=',5)->get();
        if(!is_null($id)){$data=Videos::find($id);}
        return view('admin.video.edit',compact('categories','data'));
    }

    //修改提交修改过来的视频信息
    public function update($id)
    {
        if($input=Input::except('_token','_method','file_upload')){
            if(is_null($id)){
                return back()->with('errors','提交失败');
            }else{
                if(Videos::where('id',$id)->update($input)){
                    $date=[
                        'title'=>$input['title'],
                        'type'=>1,
                        'id'=>$id
                    ];
                    $tt=Seachs::where('id',$id)->where('type',1)->get();
                    if($tt->count()!=0){
                        Seachs::where('id',$id)->where('type',1)->update($date);
                    }else{
                        Seachs::create($date);
                    }
                    return redirect('admin/video');
                }else{
                    return back()->with('errors','提交失败');
                }
            }
        }else{
            return back()->with('errors','提交失败');
        }
    }

    //删除数据
    public function destroy($tid)
    {
        $re = Videos::where('id',$tid)->delete();
        if($re){
            Seachs::where('id',$tid)->where('type',1)->delete();
            $data = [
                'status' => 1,
                'msg' => '删除成功！',
            ];
        }else{
            $data = [
                'status' => 0,
                'msg' => '删除失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //发布信息管理
    public function statusList($status)
    {
        $cates  =Category::where('type','=',1)->get();
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        if($status==3){
            //待审核
            $data=Videos::where('status',0)->orderBy('id','desc')->paginate(10);
        }else if($status==1){
            //待发布
            $data=Videos::where('status','1')->orderBy('id','desc')->paginate(10);
        }else if($status==2){
            //已发布
            $data=Videos::where('status','2')->orderBy('id','desc')->paginate(10);
        }
        return view('admin.video.statusList',compact('data','cates','status','k'));
    }

    //修改状态
    public function editState()
    {
        if($input=Input::except('_token')){
            if($input['status']==0){
                //未审核
                $data['status']=1;
                $re = Videos::where('id',$input['id'])->update($data);
                if($re){
                    $data = [
                        'status' => 0,
                        'msg' => '操作成功！',
                    ];
                }else{
                    $data = [
                        'status' => 1,
                        'msg' => '操作失败，请稍后重试！',
                    ];
                }
            }else if($input['status']==1){
                //未发布
                $data['status']=2;
                $re = Videos::where('id',$input['id'])->update($data);
                if($re){
                    $data = [
                        'status' => 0,
                        'msg' => '操作成功！',
                    ];
                }else{
                    $data = [
                        'status' => 1,
                        'msg' => '操作失败，请稍后重试！',
                    ];
                }
            }else if($input['status']==2){
                //已发布
                $data['status']=1;
                $re = Videos::where('id',$input['id'])->update($data);
                if($re){
                    $data = [
                        'status' => 0,
                        'msg' => '操作成功！',
                    ];
                }else{
                    $data = [
                        'status' => 1,
                        'msg' => '操作失败，请稍后重试！',
                    ];
                }
            }else{
                $data = [
                    'status' => 1,
                    'msg' => '操作失败，请稍后重试！',
                ];
            }
        }else{
            $data = [
                'status' => 1,
                'msg' => '操作失败，请稍后重试！',
            ];
        }
        return $data;
    }
    
    //推荐视频
    public function recommendList()
    {
        $input=Input::except('_token');
        if($input && isset($input['id'])){
            $data['recommend']=0;
            $re = Videos::where('id',$input['id'])->update($data);
            if($re){
                $data = [
                    'status' => 0,
                    'msg' => '操作成功！',
                ];
            }else{
                $data = [
                    'status' => 1,
                    'msg' => '操作失败，请稍后重试！',
                ];
            }
            return $data;
        }else{
            $cates=Category::all();
            $data=Videos::where('recommend','1')->orderBy('created_at','desc')->paginate(10);
            $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
            $k=($_GET['page']-1)*10+1;
            return view('admin.video.recommendList',compact('cates','data','k'));
        }
    }

    //期数列表
    public function issues($id)
    {   
        $issues = Issue::where('video_id','=',$id)->get();
        $videos = Videos::where('id','=',$id)->select('title','id')->first();
        return view('admin.video.issues',['video'=>$videos,'issue'=>$issues]);
    }

    //添加期数
    public function storeIssue($id=null)
    {
        $data = Input::all();
        $data['status'] = 1;
        unset($data['_token']);
        if(!$data['name'])
        {
            $date['status'] = 0;
            $date['errorMsg'] = '期数名不能为空';
        }elseif(!$data['summary'])
        {
            $date['status'] = 0;
            $date['errorMsg'] = '期数摘要不能为空';
        }elseif(!$data['url'])
        {
            $date['status'] = 0;
            $date['errorMsg'] = '视频不能为空';
        }elseif(!$data['video_id'])
        {
            $date['status'] = 0;
            $date['errorMsg'] = '参数错误';
        }else{
            if($id!=null)
            {
                if(Issue::where('id','=',$id)->update($data))
                {
                    $date['status'] = 1;      
                }else{
                    $date['status'] = 0;
                    $date['errorMsg'] = '更新失败，请稍后再试';
                }
            }elseif($id==null){
                if(Issue::create($data))
                {
                    $date['status'] = 1;      
                }else{
                    $date['status'] = 0;
                    $date['errorMsg'] = '上传失败，请稍后再试';
                }
            }
        }
        return json_encode($date);
    }

    //添加期数页面
    public function addIssue($video_id)
    {
        $videos = Videos::where('id','=',$video_id)->select('title','id')->first();
        return view('admin.video.addIssue',['video'=>$videos]);
    }

    //修改期数页面

    public function editIssue($id)
    {
        $issues = Issue::where('id','=',$id)->first();
        $video = Videos::where('id','=',$issues['video_id'])->select('title')->first();
        return view('admin.video.editIssue',['issue'=>$issues,'video'=>$video]);
    }

    //删除期数页面
    public function delIssue($id)
    {
        if(Issue::where('id','=',$id)->delete())
        {
             $data['status'] = 1;
             $data['msg'] = "删除成功";
        }else{
             $data['status'] = 0;
             $data['msg'] = "删除失败，请稍后重试！";
        }
        return $data;
    }

    //更新期数状态
    public function editIssueStatus()
    {
        $data = Input::all();
        if($data['status']==1){
            $m['status'] = 2;
        }elseif($data['status']==2){
            $m['status'] = 1;
        }
        if(!Issue::where('id','=',$data['id'])->update($m)){
            $date['status'] = 0;
        }else{
            $date['status'] = 1;
        }
        return json_encode($date);
    }

    //搜索结果
    public function seach()
    {
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        if($input=Input::except('_token')){
            $cates=Category::where('type','=',1)->get();
            if($input['type']==null){
                $data=Videos::where('title','like','%'.$input['keywords'].'%')->paginate(10);
            }else{
                $data=Videos::where('title','like','%'.$input['keywords'].'%')->where('category_id',$input['type'])->paginate(10);
            }
            return view("admin.video.index",compact("data","cates",'input','k'));
        }else{
            return back();
        }
    }
}
