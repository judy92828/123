@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">管理员列表</h3>
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
                                    <th class="sorting_asc" width="*" style="text-align: center;">登录帐号</th>
                                    <th class="sorting" width="250" style="text-align: center;">邮箱地址</th>
                                    <th class="sorting" width="250" style="text-align: center;">添加时间</th>
                                    <th class="sorting" width="300" style="text-align: center;">操作管理</th></tr>
                            </thead>
                                        <tbody>
                                        @if(!empty($data))
                                            @foreach($data as $vo)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1" align="center">{{$vo->name}}</td>
                                                    <td align="center">{{$vo->email}}</td>
                                                    <td align="center">{{$vo->created_at}}</td>
                                                    <td style="text-align: center;">
                                                        <a href="{{url('admin/userslist/'.$vo['id'].'/edit/')}}"> <button type="button" class="btn btn-success">修改</button></a>
                                                        @if($vo->id != 1)　
                                                        <a href="javascript:del({{$vo->id}})"><button type="button" class="btn btn-danger" >删除</button></a> @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table></div></div><div class="row text-center"><div class="col-sm-12"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        <ul class="pagination">
                                            {{$data->links()}}
                                        </ul></div></div></div></div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <script type="text/javascript">
        function del(tid){
            layer.confirm('您确定要删除该管理吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/userslist/')}}/"+tid,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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