@extends('admin.common.common')
@section('contentes')
	<!-- 表单 -->
		<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">添加分类</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="/admin/category" id="frm" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">分类名称</label>

                                <div class="col-sm-10">
                                    <input type="text" id="name" class="form-control" name="name" value="" placeholder="分类名称">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alias" class="col-sm-2 control-label">分类别名</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="alias" value="" name="alias" placeholder="分类别名">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">文章或视频</label>
                                <div class="col-sm-10">
                                    <input type="radio" name="type" class="flat-red" checked value="0">文章<input type="radio" name="type" value="1" class="flat-red">视频
                                </div>
                            </div>
                            <div class="form-group">
			                  <label for="pid" class="col-sm-2 control-label">父分类</label>
			                  <div class="col-sm-10">
				                  <select class="form-control" name="pid" id="pid">
                                      <option value="0">顶级分类</option>
				                    @foreach($categories as $value)
				                    	<option value="{{ $value->id }}">{{ $value->name }}</option>
				                    @endforeach
				                  </select>
			                  </div>
                			</div>
                			@if(session('error'))
                				<div style="text-align:center;color:red">
                				{{ session('error') }}
                				</div>
                			@endif
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" id="btn" class="btn btn-info pull-right">确定添加</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
	<!-- 表单结束 -->
@endsection