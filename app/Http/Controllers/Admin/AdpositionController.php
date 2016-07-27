<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Model\Adposition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class AdpositionController extends CommonController
{
    //广告位列表
    //admin/adposition
    public function index(){
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;

        $data=Adposition::orderBy("position","asc")->paginate(10);
        return view("admin.adposition.adpositionlist",compact("data","k"));
    }

    //添加广告
    //get admin/adposition/create
    public function create(){
        return view("admin.adposition.adpositioncreate");
    }

    //广告位存储
    //post admin/adposition
    public function store(){
        $input=Input::except("_token");
        $re=Adposition::create($input);
        if($re){
            return redirect("admin/adposition");
        }else{
            return back()->with("errors","添加失败");
        }
    }

     //广告位更新
    // get: admin/adposition/{ap_id}/edit
    public function edit($id)
    {
        $ap=Adposition::find($id);
        return view("admin.adposition.adpositionedit",compact("ap"));
    }

    //处理广告位更新
    //put: admin/adposition/{ap_id}
    public function update($id){
        $input=Input::except("_token","_method");
        $re=Adposition::where('id',$id)->update($input);
        if($re){
            return redirect("admin/adposition");
        }else{
            return back()->with("errors","修改失败");
        }
    }

    //广告位删除
    // admin/adposition/{ap_id}
    public function destroy($id)
    {
        $re=Adposition::where("id",$id)->delete();
        if($re){
            $data=[
                "status"=>1,
                "meg"=>"删除成功"
            ];
        }else{
            $data=[
                "status"=>0,
                "meg"=>"删除失败"
            ];
        }
        return $data;
    }

}
