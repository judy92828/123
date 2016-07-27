@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">幻灯片信息修改</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{url('admin/slide/'.$data->id)}}" class="form-horizontal" method="post">
                        <input type="hidden" name="_method" value="put">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">标题</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="{{$data->title}}" placeholder="请输入幻灯片标题">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">幻灯片链接</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="url" value="{{$data->url}}" placeholder="请输入幻灯片链接">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">幻灯片</label>
                                <div class="col-sm-10">
                                    <script src="{{asset('/admin/fileuplode/js/vendor/jquery.ui.widget.js')}}"></script>
                                    <script src="{{asset('/admin/fileuplode/js/jquery.iframe-transport.js')}}"></script>
                                    <script src="{{asset('/admin/fileuplode/js/jquery.fileupload.js')}}"></script>
                                    <input type="text" size="50" class="form-control" style="width:400px; float: left;" value="{{$data->thumb}}" name="thumb" readonly>
                                    <a href="javascript:;" class="file">选择图片上传<input id="fileupload_input" name="file_upload" type="file"></a>
                                    <script type="text/javascript">
                                        $("#fileupload_input").fileupload({
                                            url:"{{url('admin/uplode')}}",
                                            formData:{_token:"{{csrf_token()}}"},
                                            done:function(e,result){
                                                $('input[name=thumb]').val(result.result);
                                                $('#thumb').show();
                                                $('#thumb').attr('src',result.result);
                                            }
                                        })
                                    </script>
                                    <div style="clear: both;"></div>
                                    @if($data['thumb']!=null)
                                    <img id="thumb" src="{{$data->thumb}}" style="max-width: 300px; max-height: 200px; margin-top: 15px;" />
                                        @else
                                        <img id="thumb" src="" style="max-width: 300px; max-height: 200px; margin-top: 15px;" />
                                    @endif
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