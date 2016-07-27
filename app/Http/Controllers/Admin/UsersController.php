<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Model\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class UsersController extends CommonController
{
    //获取管理员列表
    public function index()
    {
        $data=Users::orderBy('id','asc')->paginate(10);
        return view('admin.userslist')->with('data',$data);
    }
    
    //创建管理员
    public function create()
    {
        return view('admin.userscreate');
    }

    //保存创建管理员提交的信息
    public function store()
    {
        if($input=Input::all()){
            $data=array(
                'name'=>$input['username'],
                'password'=>Crypt::encrypt($input['password']),
                'email'=>$input['email'],
                'type'=>$input['type']
            );
            if(Users::create($data)){
                return redirect('admin/userslist')->with('errors','添加成功');
            }else{
                return back()->with('errors','提交失败');
            }
        }else{
            return back()->with('errors','提交失败');
        }
    }

    //修改管理员信息
    public function edit($id)
    {
        if(!is_null($id)){$data=Users::find($id);}
        return view('admin.usersedit')->with('data',$data);
    }

    //修改提交修改过来的管理员信息
    public function update($id)
    {
        if($input=Input::all()){
            if(is_null($id)){
                return back()->with('errors','提交失败');
            }else{
                if(!empty($input['password'])){
                    $data['password']=Crypt::encrypt($input['password']);
                }
                $data['email']=$input['email'];
                $data['type']=$input['type'];
                if(Users::where('id',$id)->update($data)){
                    return redirect('admin/userslist')->with('errors','修改成功');
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
        $re = Users::where('id',$tid)->delete();
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
}
