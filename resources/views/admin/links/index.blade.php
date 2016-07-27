@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="float:left;">信息列表</h3>
                        <form action="{{url('admin/links/seach')}}" id="frm" method="post">
                            {{csrf_field()}}
                            <div class="input-group input-group-sm" style="width: 30%; float: right;">
                                <input type="text" name="keywords" class="form-control" placeholder="请输入搜索内容">
                                <span class="input-group-btn">
                                  <button type="submit" class="btn btn-info btn-flat">搜索</button>
                                </span>
                            </div>
                        </form>
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
                                            <th class="sorting_asc" style="text-align: center;" width="50">序号</th>
                                            <th class="sorting_asc" style="text-align: center;" width="200">信息标题</th>
                                            <th class="sorting" style="text-align: center;" width="300">链接地址</th>
                                            <th class="sorting" style="text-align: center;" width="150">信息类别</th>
                                            <th class="sorting" style="text-align: center;" width="200">发布时间</th>
                                            <th class="sorting" style="text-align: center;" width="200">操作管理</th></tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($data))
                                            @foreach($data as $vo)
                                                <tr role="row" class="odd">
                                                    <td align="center">{{$k++}}</td>
                                                    <td class="sorting_1" align="center">{{getSubstr($vo->title,0,12)}}</td>
                                                    <td align="center">{{getSubstr($vo->url,1,20)}}</td>
                                                    @if($vo->type==0)
                                                        <td align="center">友情链接</td>
                                                    @else
                                                        <td align="center">地方频道</td>
                                                    @endif
                                                    <td align="center">{{$vo->created_at}}</td>
                                                    <td style="padding-left: 50px;">
                                                        <a href="{{url('admin/links/'.$vo->id.'/edit/')}}"> <button type="button" class="btn btn-success" style="width: 50px; float: left;">修改</button></a>　
                                                        <a href="javascript:del({{$vo->id}})"><button type="button" class="btn btn-danger" style="width: 50px;">删除</button></a>
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
            layer.confirm('您确定要删除该数据吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/links/')}}/"+tid,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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