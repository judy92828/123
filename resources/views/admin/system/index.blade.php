@extends('admin.common.common')
@section('contentes')
    <script charset="utf-8" src="{{asset('/admin/kindeditor/kindeditor-all-min.js')}}"></script>
    <script charset="utf-8" src="{{asset('/admin/kindeditor/lang/zh-CN.js')}}"></script>
    <script type="text/javascript">
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="about"]', {
                allowFileManager : true
            })
            editor = K.create('textarea[name="contact"]', {
                allowFileManager : true
            })
            editor = K.create('textarea[name="follow"]', {
                allowFileManager : true
            })
        });
    </script>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">系统信息管理</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{url('admin/system')}}" id="frm" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">网站标题</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="webtitle" value="{{$sys->webtitle}}" placeholder="请输入网站标题">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">网站关键词</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="keywords" value="{{$sys->keywords}}" placeholder="请输入网站关键词">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">网站描述</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="description" name="description" rows="4"  placeholder="请输入网站描述">{{$sys->description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">网站logo</label>

                                <div class="col-sm-10">
                                    <script src="{{asset('/admin/fileuplode/js/vendor/jquery.ui.widget.js')}}"></script>
                                    <script src="{{asset('/admin/fileuplode/js/jquery.iframe-transport.js')}}"></script>
                                    <script src="{{asset('/admin/fileuplode/js/jquery.fileupload.js')}}"></script>
                                    <input type="text" size="50" class="form-control" style="width:400px; float: left;" name="img" value="{{$sys->img}}" readonly>
                                    <a href="javascript:;" class="file">选择图片上传<input id="fileupload_inputimg" name="file_upload" type="file"></a>
                                    <script type="text/javascript">
                                        $("#fileupload_inputimg").fileupload({
                                            url:"{{url('admin/uplode')}}",
                                            formData:{_token:"{{csrf_token()}}"},
                                            done:function(e,result){
                                                $('input[name=img]').val(result.result);
                                                $('#img').show();
                                                $('#img').attr('src',result.result);
                                            }
                                        })
                                    </script>
                                    <div style="clear: both;"></div>
                                    @if(is_null($sys->img))
                                        <img id="img" src="" style="max-width: 300px; max-height: 200px; margin-top: 15px;" />
                                        @else
                                        <img id="img" src="{{$sys->img}}" style="max-width: 300px; max-height: 200px; margin-top: 15px;" />
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">官方微信二维码</label>

                                <div class="col-sm-10">
                                    <script src="{{asset('/admin/fileuplode/js/vendor/jquery.ui.widget.js')}}"></script>
                                    <script src="{{asset('/admin/fileuplode/js/jquery.iframe-transport.js')}}"></script>
                                    <script src="{{asset('/admin/fileuplode/js/jquery.fileupload.js')}}"></script>
                                    <input type="text" size="50" class="form-control" style="width:400px; float: left;" value="{{$sys->weixin}}" name="weixin" readonly>
                                    <a href="javascript:;" class="file">选择图片上传<input id="fileupload_inputweixin" name="file_upload" type="file"></a>
                                    <script type="text/javascript">
                                        $("#fileupload_inputweixin").fileupload({
                                            url:"{{url('admin/uplode')}}",
                                            formData:{_token:"{{csrf_token()}}"},
                                            done:function(e,result){
                                                $('input[name=weixin]').val(result.result);
                                                $('#weixin').show();
                                                $('#weixin').attr('src',result.result);
                                            }
                                        })
                                    </script>
                                    <div style="clear: both;"></div>
                                    @if(is_null($sys->weixin))
                                        <img id="weixin" src="" style="max-width: 300px; max-height: 200px; margin-top: 15px;" />
                                    @else
                                        <img id="weixin" src="{{$sys->weixin}}" style="max-width: 300px; max-height: 200px; margin-top: 15px;" />
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">官方微博二维码</label>

                                <div class="col-sm-10">
                                    <script src="{{asset('/admin/fileuplode/js/vendor/jquery.ui.widget.js')}}"></script>
                                    <script src="{{asset('/admin/fileuplode/js/jquery.iframe-transport.js')}}"></script>
                                    <script src="{{asset('/admin/fileuplode/js/jquery.fileupload.js')}}"></script>
                                    <input type="text" size="50" class="form-control" style="width:400px; float: left;" value="{{$sys->weibo}}" name="weibo" readonly>
                                    <a href="javascript:;" class="file">选择图片上传<input id="fileupload_inputweibo" name="file_upload" type="file"></a>
                                    <script type="text/javascript">
                                        $("#fileupload_inputweibo").fileupload({
                                            url:"{{url('admin/uplode')}}",
                                            formData:{_token:"{{csrf_token()}}"},
                                            done:function(e,result){
                                                $('input[name=weibo]').val(result.result);
                                                $('#weibo').show();
                                                $('#weibo').attr('src',result.result);
                                            }
                                        })
                                    </script>
                                    <div style="clear: both;"></div>
                                    @if(is_null($sys->weibo))
                                        <img id="weibo" src="" style="max-width: 300px; max-height: 200px; margin-top: 15px;" />
                                    @else
                                        <img id="weibo" src="{{$sys->weibo}}" style="max-width: 300px; max-height: 200px; margin-top: 15px;" />
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">微信链接</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="weixinurl" value="{{$sys->weixinurl}}" placeholder="请输入微信链接">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">微博链接</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="weibourl" value="{{$sys->weibourl}}" placeholder="请输入微博链接">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">网站备案编号</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="icp" value="{{$sys->icp}}" placeholder="请输入网站备案编号">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">网站统计代码</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="tongji" name="tongji" rows="4"  placeholder="请输入网站统计代码">{{$sys->tongji}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">关于我们</label>
                                <div class="col-sm-10">
                                    <!-- 富文本编辑器 -->
                                    <div class="col-md-11" style="width: 100%; padding: 0px;">
                                        <textarea name="about" id="about" style="width: 100%; height: 400px;">{{$sys->about}}</textarea>
                                    </div>
                                    <!-- 富文本编辑器结束 -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">联系我们</label>
                                <div class="col-sm-10">
                                    <!-- 富文本编辑器 -->
                                    <div class="col-md-11" style="width: 100%; padding: 0px;">
                                        <textarea name="contact" id="contact"  style="width: 100%; height: 400px;">{{$sys->contact}}</textarea>
                                    </div>
                                    <!-- 富文本编辑器结束 -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">关注我们</label>
                                <div class="col-sm-10">
                                    <!-- 富文本编辑器 -->
                                    <div class="col-md-11" style="width: 100%; padding: 0px;">
                                        <textarea name="follow" id="follow"  style="width: 100%; height: 400px;">{{$sys->follow}}</textarea>
                                    </div>
                                    <!-- 富文本编辑器结束 -->
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" id="btn" class="btn btn-info pull-right">更新信息</button>
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