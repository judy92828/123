<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Model\Banners;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class SlideController extends CommonController
{
    //幻灯片列表
    public function index()
    {
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;

        $data=Banners::orderBy('id','desc')->paginate(10);
        return view('admin.slide.index',compact('data','k'));
    }
    
    //添加幻灯片
    public function create()
    {
        return view('admin.slide.create');
    }
    
    //保存添加提交数据
    public function store()
    {
        if($input=Input::except('_token',"file_upload")){
            if(Banners::create($input)){
                return redirect('admin/slide');
            }else{
                return back()->with('errors','保存失败');
            }
        }else{
            return back()->with('errors','保存失败');
        }
    }

    //修改幻灯片信息
    public function edit($id)
    {
        if(!is_null($id)){$data=Banners::find($id);}
        return view('admin.slide.edit')->with('data',$data);
    }

    //修改提交修改过来的幻灯片信息
    public function update($id)
    {
        if($input=Input::except('_token','_method','file_upload')){
            if(is_null($id)){
                return back()->with('errors','提交失败');
            }else{
               if(Banners::where('id',$id)->update($input)){
                    return redirect('admin/slide');
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
        $re = Banners::where('id',$tid)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '删除失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //待审核列表
    public function audit()
    {
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        $input=Input::all();
        if($input && isset($input['status'])){
            if($input['status']==0){
                $data['status']=1;
                $re = Banners::where('id',$input['id'])->update($data);
                if($re){
                    $data = [
                        'status' => 0,
                        'msg' => '审核成功！',
                    ];
                }else{
                    $data = [
                        'status' => 1,
                        'msg' => '审核失败，请稍后重试！',
                    ];
                }
            }else{
                $data = [
                    'status' => 1,
                    'msg' => '审核失败，请稍后重试！',
                ];
            }
            return $data;
        }else{
            $list=Banners::where('status',0)->paginate(10);
            return view('admin.slide.audit',compact('list','k'));
        }
    }

    //待发布列表
    public function pendingrelease()
    {
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        $input=Input::all();
        if($input && isset($input['status'])){
            if($input['status']==1){
                $data['status']=2;
                $re = Banners::where('id',$input['id'])->update($data);
                if($re){
                    $data = [
                        'status' => 0,
                        'msg' => '发布成功！',
                    ];
                }else{
                    $data = [
                        'status' => 1,
                        'msg' => '发布失败，请稍后重试！',
                    ];
                }
            }else{
                $data = [
                    'status' => 1,
                    'msg' => '发布失败，请稍后重试！',
                ];
            }
            return $data;
        }else{
            $list=Banners::where('status',1)->paginate(10);
            return view('admin.slide.pendingrelease',compact('list','k'));
        }
    }

    //已发布列表
    public function released()
    {
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        $input=Input::all();
        if($input && isset($input['status'])){
            if($input['status']==2){
                $data['status']=1;
                $re = Banners::where('id',$input['id'])->update($data);
                if($re){
                    $data = [
                        'status' => 0,
                        'msg' => '取消发布成功！',
                    ];
                }else{
                    $data = [
                        'status' => 1,
                        'msg' => '取消发布失败，请稍后重试！',
                    ];
                }
            }else{
                $data = [
                    'status' => 1,
                    'msg' => '取消发布失败，请稍后重试！',
                ];
            }
            return $data;
        }else{
            $list=Banners::where('status',2)->paginate(10);
            return view('admin.slide.released',compact('list','k'));
        }
    }
}
