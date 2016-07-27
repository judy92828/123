@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">合作机构发布管理</h3>
                        {{--{{dd($errors)}}--}}
                        {{--@if($errors!=null){{$errors}}@endif--}}
                    </div>
                    <!-- /.box-header -->
                    <style type="text/css">
                        #example2 th,td{ text-align: center;}
                    </style>
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row"><div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" style="text-align: center" width="50">序号</th>
                                            <th class="sorting_asc" width="*">机构名称</th>
                                            <th class="sorting" width="250">机构网址</th>
                                            <th class="sorting" width="250">发布时间</th>
                                            <th class="sorting" width="200">发布审核管理</th></tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($list))
                                            @foreach($list as $vo)
                                                <tr role="row" class="odd">
                                                    <td align="center">{{$k++}}</td>
                                                    <td class="sorting_1">{{getSubstr($vo->title,0,15)}}</td>
                                                    <td>{{getSubstr($vo->url,1,20)}}</td>
                                                    <td>{{$vo->created_at}}</td>
                                                    <td align="center"><div class="holder">
                                                            <div class="center">
                                                                @if($vo->status==0)
                                                                <input type="checkbox" id="checkbox-10-1"><label style="box-sizing: content-box;"  for="checkbox-10-1"  onclick="changes({{$vo->id}},{{$vo->status}})"></label>
                                                                @else
                                                                    <input type="checkbox" id="checkbox-10-2" checked=""><label for="checkbox-10-2"  style="box-sizing: content-box;"  onclick="changes({{$vo->id}},{{$vo->status}})"></label>
                                                                    @endif
                                                            </div>
                                                        </div></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table></div></div><div class="row text-center"><div class="col-sm-12"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        <ul class="pagination">
                                            {{$list->links()}}
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
            $.post("{{url('admin/agency/pendingaudit/')}}",{"_method":'post','_token':"{{csrf_token()}}","id":id,"status":state},function (data) {
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