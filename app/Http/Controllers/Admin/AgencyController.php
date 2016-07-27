<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Model\Agency;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class AgencyController extends CommonController
{
    //合作机构列表
    public function index()
    {
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        $data=Agency::orderBy('id','desc')->paginate(10);
        return view('admin.agency.index',compact('data','k'));
    }

    //添加合作机构
    public function create()
    {
        return view('admin.agency.create');
    }

    //保存添加提交数据
    public function store()
    {
        if($input=Input::except('_token')){
            if(Agency::create($input)){
                return redirect('admin/agency');
            }else{
                return back()->with('errors','保存失败');
            }
        }else{
            return back()->with('errors','保存失败');
        }
    }

    //修改合作机构信息
    public function edit($id)
    {
        if(!is_null($id)){$data=Agency::find($id);}
        return view('admin.agency.edit')->with('data',$data);
    }

    //修改提交修改过来的合作机构信息
    public function update($id)
    {
        if($input=Input::except('_token','_method')){
            if(is_null($id)){
                return back()->with('errors','提交失败');
            }else{
                if(Agency::where('id',$id)->update($input)){
                    return redirect('admin/agency');
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
        $re = Agency::where('id',$tid)->delete();
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
                $re = Agency::where('id',$input['id'])->update($data);
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
                $re = Agency::where('id',$input['id'])->update($data);
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
            $list=Agency::paginate(10);
            return view('admin.agency.pendingrelease',compact('list','k'));
        }
    }

    //搜索结果
    public function seach()
    {
        if($input=Input::except('_token')){
            $data=Agency::where('title','like','%'.$input['keywords'].'%')->paginate(20);
            return view("admin.agency.index",compact("data"));
        }else{
            return back();
        }
    }
}
