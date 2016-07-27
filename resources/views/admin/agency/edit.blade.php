@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">合作机构信息修改</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{url('admin/agency/'.$data->id)}}" id="frm" class="form-horizontal" method="post">
                        <input type="hidden" name="_method" value="put">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">机构名称</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="{{$data->title}}" placeholder="请输入机构名称">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">机构网址</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="url" value="{{$data->url}}" placeholder="请输入机构网址">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">是否立即发布</label>
                                <div class="col-sm-10">
                                    <input type="radio" class="flat-red" name="status" value="1" @if($data->status==1) checked @endif>是　<input type="radio" name="status" value="0"  @if($data->status==0) checked @endif class="flat-red">否
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" id="btn" class="btn btn-info pull-right">确定修改</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <script type="text/javascript">
        $(function(){
            $('#btn').click(function(){
                var title=$('input[name=title]').val();
                var url=$('input[name=url]').val();
                if (title == null || title == undefined || title == '') {
                    layer.msg('请输入机构名称');return false;
                }
                if (url == null || url == undefined || url == '') {
                    layer.msg('请输入机构网址');return false;
                }else{
                    $('#frm').submit();
                }
            })
        })
    </script>
@endsection