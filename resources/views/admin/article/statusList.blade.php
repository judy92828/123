@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">文章状态管理</h3>
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
                                    <th class="sorting_asc" style="text-align: center" width="50">序号</th>
                                    <th class="sorting_asc" style="text-align: center" width="*">文章标题</th>
                                    <th class="sorting_asc" style="text-align: center" width="100">分类名</th>
                                    <th class="sorting" style="text-align: center" width="100">阅读量</th>
                                    <th class="sorting" style="text-align: center" width="100">编辑</th>
                                    <th class="sorting" style="text-align: center" width="200">发布时间</th>
                                    <th class="sorting" style="text-align: center" width="150">状态</th>
                                    <th class="sorting" style="text-align: center" width="100">状态操作</th></tr>
                            </thead>
                                        <tbody>
                                        @if(!empty($data))
                                            @foreach($data as $art)
                                                <tr role="row" class="odd">
                                                    <td align="center">{{$k++}}</td>
                                                    <td class="sorting_1" align="center">{{$art->title}}</td>
                                                    <td align="center">
                                                       @foreach($cates as $cate)
                                                         @if($art->category_id==$cate->id) {{$cate->name}} @endif
                                                       @endforeach
                                                    </td>
                                                    <td align="center">{{$art->views}}</td>
                                                    <td align="center">{{$art->author}}</td>
                                                    <td align="center">{{$art->created_at}}</td>
                                                    <td align="center">@if($art->status==0) 待审核 @elseif($art->status==1) 待发布 @else 已发布 @endif</td>
                                                    <td>
                                                    	<div class="holder">
                                                            <div class="center">
                                                                <input type="checkbox" id="checkbox-10-{{$art->id}}"><label style="box-sizing: content-box;"  for="checkbox-10-{{$art->id}}"  onclick="changes({{$art->id}},{{$art->status}})"></label>
                                                            </div>
                                                        </div>
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
        function del(art_id){
            layer.confirm('您确定要删除该文章吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/article/')}}/"+art_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                    if(data.status==1){
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 6});
                    }else{
                        layer.msg(data.msg, {icon: 5});
                    }
                });
            }, function(){

            });
        }

        function changes(id,state){
            $.post("{{url('admin/article/editState/')}}",{'_token':"{{csrf_token()}}","id":id,"status":state},function (data) {
                if(data.status==0){
                    layer.msg(data.msg, {icon: 6});
                    setTimeout(function(){
                        window.location.reload();
                    },1200)
                }else{
                    layer.msg(data.msg, {icon: 5});
                }
            });
        }
    </script>
@endsection