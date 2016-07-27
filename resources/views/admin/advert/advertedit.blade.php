@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">修改广告</h3>
                        @if(count($errors)>0)
                            <div style="font-size: 16px;color: red;font-weight: bold;">
                                <!--判断$errors是对象还是只是一个数组-->
                                @if(is_object($errors))
                                    @foreach($errors->all() as $error)
                                        <p> {{$error}}</p>
                                    @endforeach
                                @else
                                    <p> {{$errors}}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{url('admin/advert/'.$advert->id)}}" id="frm" class="form-horizontal" method="post">
                        <input type="hidden" name="_method" value="put">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">广告标题</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="{{$advert->title}}" style="width: 500px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">广告链接</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{$advert->url}}" name="url" style="width: 500px;" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">缩略图</label>

                                <div class="col-sm-10">
                                    <script src="{{asset('/admin/fileuplode/js/vendor/jquery.ui.widget.js')}}"></script>
                                    <script src="{{asset('/admin/fileuplode/js/jquery.iframe-transport.js')}}"></script>
                                    <script src="{{asset('/admin/fileuplode/js/jquery.fileupload.js')}}"></script>
                                    <input type="text" size="50" class="form-control" style="width:400px; float: left;" value="{{$advert->thumb}}" name="thumb" readonly>
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
                                    @if($advert['thumb']!=null)
                                        <img id="thumb" src="{{$advert->thumb}}" style="max-width: 300px; max-height: 200px; margin-top: 15px;" />
                                    @else
                                        <img id="thumb" src="" style="max-width: 300px; max-height: 200px; margin-top: 15px;" />
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label" >广告位</label>

                                <div class="col-sm-10">
                                    <select class="form-control" name="position_id" style="width: 20%;">
                                        @foreach($aps as $ap)
                                            {{$ap->position}}
                                            <option @if($ap->position==$advert->position_id) selected @endif value="{{$ap->position}}">{{$ap->name}}</option>
                                        @endforeach
                                    </select>
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
                   layer.msg('请输入广告标题');return false;
                }
                if (url == null || url == undefined || url == '') {
                    layer.msg('请输入广告链接');return false;
                }else{
                    $('#frm').submit();
                }
            })
        })
    </script>
@endsection