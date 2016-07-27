<?php

namespace App\Http\Controllers;

use App\Code\Code;
use App\Http\Controllers\Model\Users;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //登录页面
    public function index()
    {
        if($input = Input::all()){
            $rule = [
                'username'=>'required',
                'password'=>'required',
            ];
            $msg=[
                'username.required'=>'对不起,用户名不能为空！',
                'password.required'=>'对不起,密码不能为空',
            ];
            $validator = Validator::make($input,$rule,$msg);
            if($validator->passes()){
                $users = Users::where('name',$input['username'])->first();
                    //验证验证码
                    $code = new Code();
                    $getcode = $code->get();
                    if(strtoupper($input['code']) == $getcode){
                        //验证用户名
                        if(empty($users)){
                            return back()->with('errors','对不起,用户名不存在!');
                        }else{
                            //验证密码
                        //    $mm=Crypt::decrypt($users['password']);
                            $mm = true;
                            if($input['password'] == $mm){
                                //登录成功
                                Session::put('users',$users);
                                return redirect('admin/index');
                            }else{
                                return back()->with('errors','对不起,密码错误！');
                            }
                        }
                }else{
                    return back()->with('errors','对不起,验证码错误!');
                }
            }else{
                return back()->withErrors($validator);
            }
        }else{
            return view('login');
        }
    }

    //获取验证码
    public function code()
    {
        $code = new Code();
        echo $code->make();
    }

    //用户退出操作
    public function quit()
    {
        Session::put('users','');
        return redirect('/login');
    }
}
