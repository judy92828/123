<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Model\Category;

class CategoryController extends CommonController
{

	protected $category;//分类模型对象

	public function __construct()
	{
        parent::__construct();
		$this->category = new Category;
	}
	public function index()
	{
	   $categories = $this->category->get();
       $data = $categories->toArray();
       //循环找出父分类
       for($i=0;$i<count($data);$i++)
       {
        $data[$i]['parent'] = "";
        $data[$i]['child'] = 0;
         for($j=0;$j<count($data);$j++)
         {
            if($data[$i]['parent_id']==$data[$j]['id'])$data[$i]['parent']=$data[$j]['name'];
            if($data[$i]['id']==$data[$j]['parent_id'])$data[$i]['child']=1;
         }
       }
       return view('/admin.category.index',['data'=>$data]);	
	}
    //添加分类页面
    public function create()
    {
   		$categories = $this->category->get();
    	return view('/admin.category.create',['categories'=>$categories]);
    }

    //添加类别
    public function store(Request $request)
    {
    	$name = $request->input('name');
    	if(!$name)return redirect('/admin/category/create')->with('error','分类名称不能为空'); 

		if($this->category->where('name',$name)->count()>0)
		{
			return redirect('/admin/category/create')->with('error','分类名称已存在');
		}    	
    	$this->category->name = $request->input('name');
        $this->category->type = $request->input('type');
    	$this->category->alias = $request->input('alias');
    	$this->category->parent_id = $request->input('pid');
    	$this->category->save();
    	return redirect('/admin/category');
    }

    //删除分类
    public function destroy($id)
    {
        $msg = true;
        $count = $this->category->where('parent_id',$id)->count();
        if($count>0)$msg = $this->category->where('parent_id',$id)->delete();
        $re = $this->category->destroy($id);
        if($re&&$msg){
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

    //修改分类页面
    public function edit($id)
    {
        $categories = $this->category->where('id','<>',$id)->get();
        $category = $this->category->find($id);
        return view('admin.category.edit',['categories'=>$categories,'category'=>$category]);
    }
    
    //修改分类
    public function update(Request $request,$id)
    {
        $name = $request->input('name');
        if(!$name)return redirect('/admin/category/'.$id.'/edit')->with('error','分类名称不能为空'); 

        if($this->category->where('name',$name)->where('id','<>',$id)->count()>0)
        {
            return redirect('/admin/category/'.$id.'/edit')->with('error','分类名称已存在');
        }       
        $data['name'] = $request->input('name');
        $data['type'] = $request->input('type');
        $data['alias'] = $request->input('alias');
        $data['parent_id'] = $request->input('pid');
        $this->category->where('id',$id)->update($data);
        return redirect('/admin/category');
    }
}
