<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class LinksController extends CommonController
{
    //友情链接列表
    public function index()
    {
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        $data=Links::orderBy('id','desc')->paginate(10);
        return view('admin.links.index',compact('data','k'));
    }

    //添加友情链接
    public function create()
    {
        return view('admin.links.create');
    }

    //保存添加提交数据
    public function store()
    {
        if($input=Input::except('_token')){
            if(Links::create($input)){
                return redirect('admin/links');
            }else{
                return back()->with('errors','保存失败');
            }
        }else{
            return back()->with('errors','保存失败');
        }
    }

    //修改友情链接信息
    public function edit($id)
    {
        if(!is_null($id)){$data=Links::find($id);}
        return view('admin.links.edit')->with('data',$data);
    }

    //修改提交修改过来的友情链接信息
    public function update($id)
    {
        if($input=Input::except('_token','_method')){
            if(is_null($id)){
                return back()->with('errors','提交失败');
            }else{
                if(Links::where('id',$id)->update($input)){
                    return redirect('admin/links');
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
        $re = Links::where('id',$tid)->delete();
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

    //待发布列表
    public function audit()
    {
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        $input=Input::all();
        if($input && isset($input['status'])){
            if($input['status']==0){
                $data['status']=1;
                $re = Links::where('id',$input['id'])->update($data);
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
                $data['status']=0;
                $re = Links::where('id',$input['id'])->update($data);
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
            }
            return $data;
        }else{
            $list=Links::paginate(10);
            return view('admin.links.pendingrelease',compact('list','k'));
        }
    }

    //已发布列表
    public function released()
    {
        if($input=Input::all()){
            if($input['status']==2){
                $data['status']=1;
                $re = Links::where('id',$input['id'])->update($data);
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
            $list=Links::where('status',2)->paginate(10);
            return view('admin.links.released')->with('list',$list);
        }
    }

    //搜索结果
    public function seach()
    {
        if($input=Input::except('_token')){
            $data=Links::where('title','like','%'.$input['keywords'].'%')->paginate(20);
            return view("admin.links.index",compact("data"));
        }else{
            return back();
        }
    }
}
