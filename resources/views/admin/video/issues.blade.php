@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="float:left">期数列表</h3>
                        <h3 class="box-title" style="float:right">       
                        	<a type="btn"href="{{url('admin/video/addIssue/'.$video->id)}}">添加期数</a>
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
                                    <th class="sorting_asc" style="text-align: center" width="*">期数名称</th>
                                    <th class="sorting_asc" style="text-align: center" width="100">视频名称</th>
                                    <th class="sorting" style="text-align: center" width="100">视频摘要</th>
                                    <th class="sorting" style="text-align: center" width="200">发布时间</th>
                                    <th class="sorting" style="text-align: center" width="100">状态</th>
                                    <th class="sorting" style="text-align: center" width="150">操作管理</th>
                                    <th class="sorting" style="text-align: center" width="100">状态管理</th>
                                </tr>

                            </thead>
                                        <tbody>
                                        @if(!empty($issue))
                                            @foreach($issue as $v)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1" align="center">{{$v->name}}</td>
                                                    <td align="center">
                                                       {{ $video['title'] }}
                                                    </td>
                                                    <td align="center">{{  mb_substr($v->summary,0,10,'utf-8')  }}</td>
                                                    <td align="center">{{$v->created_at}}</td>
                                                    <td align="center">@if($v->status==1) 待发布 @else 已发布 @endif</td>
                                                    <td>
                                                        <a href="{{url('admin/video/editIssue/'.$v->id)}}"> <button type="button" class="btn btn-success">修改</button></a> <a href="javascript:del({{$v->id}})"><button type="button" class="btn btn-danger">删除</button></a>                                          
                                                    </td>
                                                    <td align="center">
                                                    	<div class="holder">
                                                            <div class="center">
                                                                <input type="checkbox" @if($v->status==2)checked="checked"@endif id="checkbox-10-{{$v->id}}"><label style="box-sizing: content-box;"  for="checkbox-10-{{$v->id}}"  onclick="changes({{$v->id}},{{$v->status}})"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table></div></div><div class="row text-center"><div class="col-sm-12"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        </div></div></div></div>
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
            layer.confirm('您确定要删除该视频吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/video/delIssue')}}/"+art_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                    if(data.status==1){
                        layer.msg(data.msg, {icon: 6});
                        setTimeout(function(){
                            window.location.reload();
                        },1200)
                    }else{
                        layer.msg(data.msg, {icon: 5});
                    }
                });
            }, function(){

            });
        }

        function changes(id,status)
        {
        	var data = {};
        	data['id'] = id;
        	data['status'] = status;
        	data['_token'] = "{{csrf_token()}}";
        	$.post('/admin/video/editIssueStatus',data,function(m){
        		if(m.status==1){
        			window.location.reload();
        		}else if(m.status==0){
        			layer.msg('发布失败，请稍后再试');
        			return false;
        		}
        	},'json');
        }
    </script>
@endsection