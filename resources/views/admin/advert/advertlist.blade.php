@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">广告列表</h3>
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
                                    <th class="sorting" style="text-align: center" width="150">广告位</th>
                                    <th class="sorting" style="text-align: center" width="200">发布时间</th>
                                    <th class="sorting" style="text-align: center" width="150">状态</th>
                                    <th class="sorting" style="text-align: center" width="200">操作管理</th></tr>
                            </thead>
                                        <tbody>
                                        @if(!empty($data))
                                            @foreach($data as $ad)
                                                <tr role="row" class="odd">
                                                    <td align="center">{{$k++}}</td>
                                                    <td class="sorting_1" align="center">{{$ad->title}}</td>
                                                    <td align="center">{{$ad->views}}</td>
                                                    <td align="center">@foreach($adps as $adp) @if($adp->position==$ad->position_id) {{$adp->name}}  @endif @endforeach</td>
                                                    <td align="center">{{$ad->created_at}}</td>
                                                    <td align="center">@if($ad->status==0) 待审核 @elseif($ad->status==1) 待发布 @else 已发布 @endif</td>
                                                    <td style="padding-left:50px"><a href="{{url('admin/advert/'.$ad->id.'/edit')}}"> <button type="button" class="btn btn-success" style="width: 50px; float: left;">修改</button></a>　
                                                        <a href="javascript:;"><button type="button" onclick="delAdvert({{$ad->id}})" class="btn btn-danger" style="width: 50px;">删除</button></a>
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
    //删除分类
    function delAdvert(ad_id) {
        layer.confirm('您确定要删除这个广告吗？', {
            btn: ['确定', '取消'] //按钮
        }, function () {
            $.post("{{url('admin/advert/')}}/"+ad_id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
                if(data.status==1){
                    //刷新当前页面
                    location.href=location.href;
                    layer.alert(data.msg, {icon: 6});
                }else{
                    layer.msg(data.msg, {icon: 5});
                }
            })
        }, function () {

        });
    }
</script>
@endsection
