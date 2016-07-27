@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">推荐视频</h3>
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
                                    <th class="sorting_asc" style="text-align: center" width="*">视频标题</th>
                                    <th class="sorting_asc" style="text-align: center" width="100">分类名</th>
                                    <th class="sorting" style="text-align: center" width="100">视频类型</th>
                                    <th class="sorting" style="text-align: center" width="200">发布时间</th>
                                    <th class="sorting" style="text-align: center" width="200">状态操作</th></tr>
                            </thead>
                                        <tbody>
                                        @if(!empty($data))
                                            @foreach($data as $art)
                                                <tr role="row" class="odd">
                                                    <td align="center">{{$k++}}</td>
                                                    <td class="sorting_1" align="center">{{getSubstr($art->title,0,15)}}</td>
                                                    <td align="center">
                                                       @foreach($cates as $cate)
                                                         @if($art->category_id==$cate->id) {{$cate->name}} @endif
                                                       @endforeach
                                                    </td>
                                                    <td align="center">@if($art->type==0) 原创视频 @elseif($art->type==1) 转载视频 @endif</td>
                                                    <td align="center">{{$art->created_at}}</td>
                                                    <td>
                                                    	<div class="holder" style="background: white; text-align: center;">
                                                            <div class="center">
                                                                    <input type="checkbox" id="checkbox-10-{{$art->id}}" checked=""><label for="checkbox-10-{{$art->id}}"  style="box-sizing: content-box;"  onclick="changes({{$art->id}},{{$art->status}})"></label>
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

        function changes(id,state){
            $.post("{{url('admin/video/recommendList/')}}",{'_token':"{{csrf_token()}}","id":id,"status":state},function (data) {
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