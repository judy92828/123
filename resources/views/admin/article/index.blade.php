@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        @if($action=='seach')
                        <h3 class="box-title" style="float:left;"><a href="{{url('admin/article')}}">返回列表</a></h3>
                        @else
                            <h3 class="box-title" style="float:left;">文章列表</h3>
                            @endif
                        <form action="{{url('admin/article/seach')}}" id="frm" method="post">
                            {{csrf_field()}}
                            <div class="input-group input-group-sm" style="width: 30%; float: right;">
                                    <select class="form-control" style="float: left;width:48%;" name="type">
                                            @foreach($cates as $cate)
                                            @if($cate->parent_id!=0)
                                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                                            @endif
                                            @endforeach
                                    </select>
                                <input type="text"style="width:50%; margin-left:2%"  name="keywords" class="form-control" placeholder="请输入搜索内容">
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
                                    <th class="sorting_asc" style="text-align: center" width="50">序号</th>
                                    <th class="sorting_asc" style="text-align: center" width="*">文章标题</th>
                                    <th class="sorting_asc" style="text-align: center" width="100">分类名</th>
                                    <th class="sorting" style="text-align: center" width="100">阅读量</th>
                                    <th class="sorting" style="text-align: center" width="100">编辑</th>
                                    <th class="sorting" style="text-align: center" width="200">发布时间</th>
                                    <th class="sorting" style="text-align: center" width="100">状态</th>
                                    <th class="sorting" style="text-align: center" width="150">操作管理</th></tr>
                            </thead>
                                        <tbody>
                                        @if(!empty($data))
                                            @foreach($data as $art)
                                                <tr role="row" class="odd">
                                                    <td align="center">{{$k++}}</td>
                                                    <td class="sorting_1" align="center">{{getSubstr($art->title,0,13)}}</td>
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
                                                        <a href="{{url('admin/article/'.$art->id.'/edit/')}}"> <button type="button" class="btn btn-success" style="width: 50px; float: left;">修改</button></a>　
                                                        <a href="javascript:del({{$art->id}})"><button type="button" class="btn btn-danger" style="width: 50px;">删除</button></a
                                                        ></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table></div></div><div class="row text-center"><div class="col-sm-12"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        <ul class="pagination">
                                            @if($action=='seach')
                                                @if(!empty($keywords))
                                                    {!! $data->appends(['keywords'=>$input['keywords'],'type'=>$type])->render() !!}
                                                @else
                                                    {!! $data->appends(['type'=>$type])->render() !!}
                                                @endif
                                            @else
                                                {{$data->links()}}
                                            @endif

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

        //分类搜索
        function ctseach(){
            var cat=document.getElementById("ct").value;
            location.href = "article/catseach/"+cat;
        }
    </script>
@endsection