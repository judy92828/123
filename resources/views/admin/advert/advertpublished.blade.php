@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">广告状态管理</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row"><div class="col-sm-12">
                        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" style="text-align: center" width="*">序号</th>
                                    <th class="sorting_asc" style="text-align: center" width="*">广告标题</th>
                                    <th class="sorting" style="text-align: center" width="100">点击次数</th>
                                    <th class="sorting" style="text-align: center" width="100">广告位</th>
                                    <th class="sorting" style="text-align: center" width="200">发布时间</th>
                                    <th class="sorting" style="text-align: center" width="150">状态</th>
                                    <th class="sorting" style="text-align: center" width="200">取消发布</th></tr>
                            </thead>
                                        <tbody>
                                        @if(!empty($data))
                                            @foreach($data as $ad)
                                                <tr role="row" class="odd">
                                                    <td align="center">{{$k++}}</td>
                                                    <td class="sorting_1" style="text-align: center">{{$ad->title}}</td>
                                                    <td style="text-align: center">{{$ad->views}}</td>
                                                    <td style="text-align: center">{{$ad->position_id}}</td>
                                                    <td style="text-align: center">{{$ad->created_at}}</td>
                                                    <td style="text-align: center">@if($ad->status==2) 已发布 @endif</td>
                                                    <td><div class="holder" style="background: white;">
                                                            <div class="center" style="text-align: center">
                                                                <input type="checkbox" id="checkbox-10-1" checked=""><label style="box-sizing: content-box;"  for="checkbox-10-1"  onclick="changes({{$ad->id}},{{$ad->status}})"></label>
                                                            </div>
                                                        </div></td>
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
        $.post("{{url('admin/advert/published')}}",{'_token':"{{csrf_token()}}","id":id,"status":state},function (data) {
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
