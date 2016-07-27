@extends('admin.common.common')
@section('contentes')
    <link rel="stylesheet" href="/admin/plugins/iCheck/all.css">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">添加幻灯片</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{url('admin/slide')}}" id="frm" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">标题</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="" placeholder="请输入幻灯片标题">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">幻灯片链接</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="url" value="" placeholder="请输入幻灯片链接">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">幻灯片</label>

                                <div class="col-sm-10">
                                    <script src="{{asset('/admin/fileuplode/js/vendor/jquery.ui.widget.js')}}"></script>
                                    <script src="{{asset('/admin/fileuplode/js/jquery.iframe-transport.js')}}"></script>
                                    <script src="{{asset('/admin/fileuplode/js/jquery.fileupload.js')}}"></script>
                                    <input type="text" size="50" class="form-control" style="width:400px; float: left;" name="thumb" readonly>
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
                                    <img id="thumb" src="" style="max-width: 300px; max-height: 200px; margin-top: 15px;" />
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" id="btn" class="btn btn-info pull-right">确定添加</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <script src="/admin/plugins/iCheck/icheck.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#btn').click(function(){
                var title=$('input[name=title]').val();
                var url=$('input[name=url]').val();
                var thumb=$('input[name=thumb]').val();
                if (title == null || title == undefined || title == '') {
                   layer.msg('请输入标题内容');return false;
                }
                if (thumb == null || thumb == undefined || thumb == '') {
                    layer.msg('请上传幻灯图片');return false;
                }
                if (url == null || url == undefined || url == '') {
                    layer.msg('请输入链接地址');return false;
                }else{
                    $('#frm').submit();
                }
            })
        })
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
    </script>
@endsection