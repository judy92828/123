<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Model\Adposition;
use App\Http\Controllers\Model\ads;
use App\Http\Controllers\Model\Banners;
use Illuminate\Http\Request;



use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\CommonController;

class AdvertController extends CommonController
{
    //广告列表
    //admin/advert
    public function index()
    {
        //根据分页来显示每条数据递增
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;

        $data=ads::orderBy('id','desc')->paginate(10);
        $adps=Adposition::get();
        return view('admin.advert.advertlist',compact('data','adps','k'));
    }

    //广告添加页面
    //get admin/advert/create
    public function create()
    {
        $aps=Adposition::all();
        return view('admin.advert.advertcreate',compact("aps"));
    }
    
    //广告存储
    //post admin/advert
    public function store()
    {
       $input=Input::except("_token","file_upload");
       $re=ads::create($input);
       if($re){
          return redirect("admin/advert");
       }else{
          return back()->with('errors','添加失败,请稍后重试....');
       }
    }

    //广告更新
    // get: admin/advert/{advert}/edit
    public function edit($id)
    {
        $advert=ads::find($id);
        $aps=Adposition::all();
        return view("admin.advert.advertedit",compact("advert","aps"));
    }

    //处理广告更新
    //put: admin/advert/{advert}
    public function update($id){
        $input=Input::except("_token","_method","file_upload");
        //判断是否更换缩略图
        $advert=ads::find($id);
        //如果更换了缩略图就把相应文件中的缩略图删除
        if($input['thumb']!=$advert->thumb){
            $pattern='/[0-9]+(\.jpg|\.jpeg|\.png)$/';
            $arr=array();
            preg_match($pattern,$advert->thumb,$arr);
            $key =$arr[0];
            $this->deletefile($key);
        }
        if(ads::where('id',$id)->update($input)){
            return redirect("admin/advert");
        }else{
            return back()->with("errors","更新失败");
        }
    }

    //广告删除
    // admin/advert/{advert}
    public function destroy($ad_id)
    {
          $advert=ads::find($ad_id);
          $re=ads::where('id',$ad_id)->delete();
          if($re){
             //删除相应图片
             $pattern='/[0-9]+(\.jpg|\.jpeg|\.png)$/';
             $arr=array();
             preg_match($pattern,$advert->thumb,$arr);
             $key =$arr[0];
             $this->deletefile($key);
             $data=[
                'status'=>1,
                'msg'=>'删除成功'
            ];
          }else{
            $data=[
                'status'=>0,
                'msg'=>'删除失败,请稍后重试'
             ];
         }
        return $data;
    }
    
    //未审核显示
    //admin/advert/audit
    function audit(){
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        $input=Input::all();
        if($input && isset($input['status'])){
            if ($input['status'] == 0) {
                $data['status'] = 1;
                $re =ads::where('id', $input['id'])->update($data);
                if ($re) {
                    $data = [
                        'status' => 0,
                        'msg' => '审核成功！',
                    ];
                } else {
                    $data = [
                        'status' => 1,
                        'msg' => '审核失败，请稍后重试！',
                    ];
                }
             } else {
                $data = [
                    'status' => 1,
                    'msg' => '审核失败，请稍后重试！',
                ];
            }
            return $data;
        }else{
            $data = ads::where('status', 0)->orderBy('id', "desc")->paginate(10);
            return view("admin.advert.advertaudit", compact("data",'k'));
        } 
    }
    
    //待发布
    function publish(){
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        $input=Input::all();
        if($input && isset($input['status'])){
            if ($input['status'] == 1) {
                $data['status'] = 2;
                $re =ads::where('id', $input['id'])->update($data);
                if ($re) {
                    $data = [
                        'status' => 0,
                        'msg' => '发布成功！',
                    ];
                } else {
                    $data = [
                        'status' => 1,
                        'msg' => '发布失败，请稍后重试！',
                    ];
                }
            } else {
                $data = [
                    'status' => 1,
                    'msg' => '发布失败，请稍后重试！',
                ];
            }
            return $data;
        }else {
            $data = ads::where('status', 1)->orderBy("id", "desc")->paginate(10);
            return view("admin.advert.advertpublish", compact("data","k"));
        }
    }
    
    //已发布
    function published(){
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        $input=Input::all();
        if($input && isset($input['status'])){
            if($input['status']==2){
                $data['status']=1;
                $re = ads::where('id',$input['id'])->update($data);
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
            $data=ads::where('status',2)->orderBy('id',"desc")->paginate(10);
            return view('admin.advert.advertpublished',compact("data","k"));
        }
    }

    public function show(){

    }
    
}
