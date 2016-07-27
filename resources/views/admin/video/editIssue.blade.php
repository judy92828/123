@extends('admin.common.common')
@section('contentes')
	<section class='content' style="background-color:white">
		<div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">修改期数信息</h3>
                    </div>        
                    <form class="form-horizontal">
                    	<div class="box-body">
                    		<div class="form-group">
                                <label for="video_name" class="col-sm-2 control-label">视频名称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="video_name" value="{{$video->title}}" readonly>                            
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">期数名称</label>
                                <div class="col-sm-10">
                                    <input type="text" id="name" class="form-control" name="name" value="{{$issue->name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summary" class="col-sm-2 control-label">期数摘要</label>
                                <div class="col-sm-10">
                                    <textarea rows="3" class="form-control" name="summary" id="summary">{{$issue->summary}}</textarea>
                                </div>
                            </div>
                        	<!-- 上传视频 -->
                        	<div class="form-group">
                                <label for="url" class="col-sm-2 control-label">上传视频</label>

                                <div class="col-sm-10">
                                    <script src="{{asset('/admin/fileuplode/js/vendor/jquery.ui.widget.js')}}"></script>
                                    <script src="{{asset('/admin/fileuplode/js/jquery.iframe-transport.js')}}"></script>
                                    <script src="{{asset('/admin/fileuplode/js/jquery.fileupload.js')}}"></script>
                                    <input type="text" id="url" size="50" class="form-control" style="width:400px; float: left;" name="url" value="{{$issue->url}}">
                                    <a href="javascript:;" class="file">选择视频上传<input id="fileupload_input" name="file_upload" type="file"></a>
                                    <script type="text/javascript">
                                        $("#fileupload_input").fileupload({
                                            url:"{{url('admin/uplode')}}",
                                            formData:{_token:"{{csrf_token()}}"},
                                            done:function(e,result){
                                                $('input[name=url]').val(result.result);                              
                                            }
                                        })
                                    </script>
                                    <div style="clear: both;"></div>                               
                                </div>
                            </div>
                        	<!-- end -->    
                    	</div>
                    	<div class="col-md-12" style="margin:5px;">
			   				<input type="button" name="button" class="btn" style="float:right;background-color:#00c0ef;color:white;" value="确认提交" onclick="refer()">
			   			</div>
                    </form>
                </div>    
        </div> 
	</section>
	<script type="text/javascript">
		function refer()
		{
			var data = {};
			data['name'] = $('#name').val();
			if(data['name']=="")
			{
				layer.msg('请输入期数名称');
                 $('#name').focus();
				return false;
			}
			data['summary']	= $('#summary').val();
			if(data['summary']=="")
			{
				layer.msg('请输入期数摘要');
				$('#summary').focus();
				return false;
			}
			data['url'] = $('#url').val();
			if(data['url']=="")
			{
				layer.msg('请选择视频上传');
				$('#url').focus();
				return false;
			}
			data['video_id'] = "{{$issue->video_id}}";
			data['_token'] = "{{csrf_token()}}"
			$.post('/admin/video/storeIssue/{{$issue->id}}',data,function(m){
				if(m.status==0)
				{
					layer.msg(m.errorMsg);
				}else if(m.status==1){
					layer.msg('更新成功');
					location.href = '/admin/video/issues/{{$issue->video_id}}';
				}
			},'json');
		}
	</script>
@endsection