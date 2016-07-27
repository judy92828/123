@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">友情链接信息修改</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{url('admin/links/'.$data->id)}}" class="form-horizontal" method="post">
                        <input type="hidden" name="_method" value="put">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">链接标题</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="{{$data->title}}" placeholder="请输入链接标题">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">链接地址</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="url" value="{{$data->url}}" placeholder="请输入链接地址">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">信息类别</label>
                                <div class="col-sm-10">
                                    <input type="radio" class="flat-red" name="type" value="0" @if($data->type==0) checked @endif>友情链接　<input type="radio" class="flat-red" name="type" value="1"  @if($data->type==1) checked @endif>地方频道
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">是否立即发布</label>
                                <div class="col-sm-10">
                                    <input type="radio" name="status" class="flat-red" value="1" @if($data->status==1) checked @endif>是　<input type="radio" name="status" value="0"  @if($data->status==0) checked @endif class="flat-red" >否
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">确定修改</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection