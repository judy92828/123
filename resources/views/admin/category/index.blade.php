@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">分类列表</h3>
                        {{--{{dd($errors)}}--}}
                        {{--@if($errors!=null){{$errors}}@endif--}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row"><div class="col-sm-12">
                        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" style="text-align: center;" width="100">序号</th>
                                    <th class="sorting_asc" style="text-align: center;" width="*">分类名称</th>
                                    <th class="sorting" style="text-align: center;" width="250">分类别名</th>
                                    <th class="sorting" style="text-align: center;" width="250">父分类</th>
                                    <th class="sorting" style="text-align: center;" width="300">操作管理</th></tr>
                            </thead>
                                        <tbody>
                                        @if(!empty($data))
                                        	@for($i=0;$i<count($data);$i++)
                                        		<tr role="row" class="odd">
                                                    <td align="center">{{$data[$i]['id']}}</td>
                                                    <td align="center" class="sorting_1">{{ $data[$i]['name'] }}</td>
                                                    <td align="center">{{ $data[$i]['alias'] }}</td>
                                                    <td align="center">@if($data[$i]['parent']==null) 顶级分类 @else {{ $data[$i]['parent'] }} @endif</td>
                                                    <td style="padding-left:100px;">
                                                        <a href="/admin/category/{{ $data[$i]['id'] }}/edit"> <button type="button" class="btn btn-success" style="width: 50px; float: left;">修改</button></a>　
                                                        <a href="javascript:del({{ $data[$i]['id'] }},{{ $data[$i]['child'] }})" style="display: none;"><button type="button" class="btn btn-danger" style="width: 50px;">删除</button></a>
                                                    </td>
                                                </tr>
                                        	@endfor
                                        @endif
                                        </tbody>
                                    </table></div></div></div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <script type="text/javascript">
        function del(tid,child){
        	var msg = '您确定要删除该分类吗？';
        	if(child)msg='删除该分类将同时删除子类，您确定要删除该分类？';
            layer.confirm(msg, {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/category/')}}/"+tid,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                    if(data.status==0){
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 6});
                    }else{
                        layer.msg(data.msg, {icon: 5});
                    }
                });
            }, function(){

            });
        }
    </script>
@endsection