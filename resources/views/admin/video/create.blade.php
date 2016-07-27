@extends('admin.common.common')
@section('contentes')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">添加视频</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form class="form" action="{{url('admin/video')}}" method="post" id="frm"  style="padding:15px;margin-top:10px">
					{{csrf_field()}}
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="summary" >视频类型</label>
								<input type="radio" name="type" value="0" onclick="change(0)"  checked="checked"/>
								原创　
								<input type="radio" name="type" onclick="change(1)" value="1" />
								转载 </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="category_id">视频分类</label>
								<select class="form-control" name="category_id" id="category_id" value="">

									@foreach($categories as $value)

										<option value="{{ $value->id }}">{{ $value->name }}</option>

									@endforeach

								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="title">视频标题</label>
								<input type="text" class="form-control" id="title" name="title" value="" placeholder="视频标题">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="keywords">关键字</label>
								<input type="text" class="form-control" id="keywords" name="keywords" value="" placeholder="每个关键字请用中文逗号隔开">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="source">视频来源</label>
								<input type="text" class="form-control" id="source" name="source" value="" placeholder="原创可为空">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="summary">视频摘要</label>
								<textarea class="form-control" id="summary" name="summary" rows="4" value=""></textarea>
							</div>
						</div>
						<!-- 缩略图上传 -->
						<div class="col-md-5">
							<div class="form-group">
								<label for="thumbnail">缩略图上传</label>
								<script src="{{asset('/admin/fileuplode/js/vendor/jquery.ui.widget.js')}}"></script>
								<script src="{{asset('/admin/fileuplode/js/jquery.iframe-transport.js')}}"></script>
								<script src="{{asset('/admin/fileuplode/js/jquery.fileupload.js')}}"></script>
								<div class="input-group"> <span class="input-group-btn">
                  <button class="btn btn-default" type="button" style="background-color:#D0EEFF;padding:0px">
					  <a href="javascript:;" class="file" style="margin:0;padding:4px;border:0">选择图片
						  <input id="thumbnail" name="file_upload" type="file">
					  </a>
				  </button>
                  </span>
									<input type="text" size="50" class="form-control" name="thumbnail" value="" readonly>
								</div>
								<script type="text/javascript">
									$("#thumbnail").fileupload({
										url:"{{url('admin/uplode')}}",
										formData:{_token:"{{csrf_token()}}"},
										done:function(e,result){
											$('input[name=thumbnail]').val(result.result);
											$('#thumb').show();
											$('#thumb').attr('src',result.result);
										}
									})
								</script>
								<div style="clear: both;"></div>
								<img id="thumb" src="" style="max-width: 300px; max-height: 200px; margin-top: 15px;" /> </div>
						</div>
						<!-- 缩略图上传结束 -->
						<div class="col-md-12" id="link">
							<div class="form-group">
								<label for="summary">转载视频链接</label>
								<input type="text" size="200" class="form-control" name="url" value="" placeholder="只对转载类别有效,原创为空即可">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="summary">是否推荐视频</label>
								<input type="radio" class="flat-red" name="recommend" value="1">
								推荐　
								<input type="radio" name="recommend" value="0" checked class="flat-red">
								不推荐 </div>
						</div>
						<div class="col-md-12" style="margin:5px;">
							<input type="button" name="button" class="btn" style="float:right;background-color:#00c0ef;color:white;" value="确认提交" onclick="refer()">
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>

	<script type="text/javascript">
		$('#link').hide();
		function refer()
		{
			if($('#title').val()=="")
			{
				    layer.msg('请输入视频标题');
					$('#title').focus();
					return false;
			}
			if($('#summary').val()=="")
			{
				    layer.msg('请输入视频描述');
					$('#summary').focus();
					return false;
			}
				$('#frm').submit();
		}

		function change(type){
			if(type==0){
				$('#link').hide();
			}else if(type==1){
				$('#link').show();
			}
		}
	</script>
@endsection