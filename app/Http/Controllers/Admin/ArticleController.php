<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Model\Seachs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Model\Category;
use App\Http\Controllers\Model\Article;
use Illuminate\Support\Facades\Input;

class ArticleController extends CommonController
{
    protected $request;

    public function __construct(Request $request)
    {
        parent::__construct();
    	$this->request = $request;
    }


    //文章列表
    public function index()
    {
        //获取分类
        $cates=Category::where('type','=',0)->get();
        $data=Article::orderBy("id","desc")->paginate(10);
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        return view("admin.article.index",compact("data","cates",'k'));
    }
    
    //文章添加页面
    public function create()
    {
    	$category = new Category;
    	$categories = $category->where('type',0)->get();
        foreach($categories as $key=>$vo){
            if($category->where('parent_id',$vo['id'])->get()){
                unset($category[$key]);
            }
        }
    	return view('admin.article.create',['categories'=>$categories]);
    }

    //文章存储
    public function store()
    {
        $aObj = new Article;
        $data = $this->request->input('content');
        if($data['content']==""){
            $msg = $this->_error('请输入文章内容');
        }elseif($data['category_id']==""){
            $msg = $this->_error('请选择文章分类');
        }elseif($data['title']==""){
            $msg = $this->_error('请输入文章标题');
        }elseif($data['thumbnail']==""){
            $msg = $this->_error('请上传缩略图');
        }else{
           $user = session('users');
           $data['author'] = $user['name'];
           foreach ($data as $k => $v) {
                $aObj->$k = $v;   
           }
            if($aObj->save()){
                $date=[
                    'title'=>$data['title'],
                    'type'=>0,
                    'id'=>$aObj->id
                ];
                Seachs::create($date);
                $msg['status'] = 1;
                $msg['errorMsg'] = "上传成功";
            }else{
                $msg['status'] = 0;
                $msg['errorMsg'] = "上传失败，请稍后再试";
            }
        }
        return json_encode($msg);
    }

    //文章更新
    // get: admin/article/{article}/edit
    public function edit($id)
    {
        //获取分类
        //不显示的顶级分类
        $arr=array('1','5','9','13');
        $cates=Category::where('type','=',0)->whereNotIn('id',$arr)->get();
        $article=Article::find($id);
        return view("admin.article.edit",compact("cates","article"));
    }

    //处理文章更新
    //put: admin/article/{article}
    public function update($id){
        $input=Input::all();
        $data=$input['content'];
//        $art=Article::find($id);
//        //如果更换了缩略图就把相应文件中的缩略图删除
//        if($art->thumbnail!=$data['thumbnail']){
//            $arr=explode("/",$art->thumbnail);
//            $artthumb=$arr[1]."/".$arr[2];
//            if (file_exists($artthumb)) {
//                unlink($artthumb);
//            }
//        }
//        if($art->image!=$data['image']){
//        $arr=explode("/",$art->image);
//        $artimage=$arr[1]."/".$arr[2];
//        if (file_exists( $artimage)) {
//            unlink( $artimage);
//          }
//       }

        if(Article::where("id",$id)->update($data)){
            $date=[
                'title'=>$data['title'],
                'type'=>0,
                'id'=>$id
            ];
            $tt=Seachs::where('id',$id)->where('type',0)->get();
            if($tt->count()!=0){
                Seachs::where('id',$id)->where('type',0)->update($date);
            }else{
                Seachs::create($date);
            }
            $msg['status'] = 1;
            $msg['errorMsg'] = "修改成功";
        }else{
            $msg['status'] = 0;
            $msg['errorMsg'] = "修改失败";
        }
        return json_encode($msg);
    }

    //不同状态的文章列表
    public function statusList($status)
    {
        $cates=Category::all();
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        if($status==3){
            $data=Article::where('status','0')->orderBy("id","desc")->paginate(10);
        }else{
            $data=Article::where('status',$status)->orderBy("id","desc")->paginate(10);
        }
        return view("admin.article.statusList",compact("data","cates",'status','k'));
    }

    //更新文章状态
    public function editState()
    {
        $id = $this->request->input('id');
        $status = $this->request->input('status');
        $obj = new Article;
        switch ($status)
        {
            case 0:
                $res = $obj->where('id',$id)->update(['status'=>1]);
                if($res){
                    $data['status'] = 0;
                    $data['msg'] = '审核成功';  
                }else{
                    $data['status'] = 1;
                    $data['msg'] = '审核失败';
                }
                break;
            case 1:
                $res = $obj->where('id',$id)->update(['status'=>2]);
                if($res){
                    $data['status'] = 0;
                    $data['msg'] = '发布成功';
                }else{
                    $data['status'] =  1;
                    $data['msg'] = '发布失败';
                }
                break;
            case 2:
                $res = $obj->where('id',$id)->update(['status'=>1]);
                if($res){
                    $data['status'] = 0;
                    $data['msg'] = '取消发布成功';
                }else{
                    $data['status'] = 0;
                    $data['msg'] = '取消发布失败';
                }
                break;
        }
        return $data;
    }

    //错误信息处理
    private function _error($error)
    {
        $msg['status'] = 0;
        $msg['errorMsg'] = $error;
        return $msg;
    }
    
    //搜索结果
    public function seach()
    {
        $_GET['page']=isset($_GET['page'])?$_GET['page']:1;
        $k=($_GET['page']-1)*10+1;
        if($input=Input::except('_token')){
            foreach($input as $key=>$vo){
                if(empty($vo)){
                    unset($input[$key]);
                }
            }
            $cates=Category::where('type','=',0)->get();
            if(empty($input['keywords'])){
                $data=Article::where('category_id',$input['type'])->paginate(10);
            }else{
                $data=Article::where('title','like','%'.$input['keywords'].'%')->where('category_id',$input['type'])->paginate(10);
            }
            $type=$input['type'];
            if(empty($input['keywords'])){
                return view("admin.article.index",compact("data","cates",'input','k','type'));
            }else{
                $keywords=$input['type'];
                return view("admin.article.index",compact("data","cates",'input','k','keywords','type'));
            }
        }else{
            return back();
        }
    }
    

    //文章删除
    // admin/article/{article}
    public function destroy($at_id)
    {
        $art=Article::find($at_id);
        $re=Article::where('id',$at_id)->delete();
        if($re){
            //删除相应图片
            $pattern='/[0-9]+(\.jpg|\.jpeg|\.png)$/';
            $arr=array();
            preg_match($pattern,$art->thumbnail,$arr);
            $key =$arr[0];
            $this->deletefile($key);
            Seachs::where('id',$at_id)->where('type',0)->delete();
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

}
