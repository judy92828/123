@extends('admin.common.common')
@section('contentes')
	<script type="text/javascript" src="/admin/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="/admin/ueditor/ueditor.all.js"></script>
	<section class='content' style="background-color:white">
		@if(session('error'))

		@endif
		<form class="form" action="{{url('admin/video/'.$data->id)}}" id="frm" method="post">
			{{csrf_field()}}
			<input type="hidden" name="_method" value="put">
			<input type="hidden" name="id" value="{{$data->id}}">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="summary">视频类型</label>
						<input type="radio" name="type" value="0" onclick="change(0)" @if($data->type==0) checked @endif>原创　<input type="radio" name="type" onclick="change(1)" value="1" @if($data->type==1) checked @endif>转载
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="category_id">视频分类</label>
						<select class="form-control" name="category_id" id="category_id" value="">
							@foreach($categories as $value)
								<option value="{{ $value->id }}" @if($value->id==$data->category_id) selected @endif>{{ $value->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="title">视频标题</label>
						<input type="text" class="form-control" id="title" name="title" value="{{$data->title}}" placeholder="视频标题">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="keywords">关键字</label>
						<input type="text" class="form-control" id="keywords" name="keywords" value="{{$data->keywords}}" placeholder="每个关键字请用中文逗号隔开">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="source">视频来源</label>
						<input type="text" class="form-control" id="source" name="source" value="{{$data->source}}" placeholder="原创可为空">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="summary">视频摘要</label>
						<textarea class="form-control" id="summary" name="summary" rows="4" value="">{{$data->summary}}</textarea>
					</div>
				</div>
				<!-- 缩略图上传 -->
				<div class="col-md-5">
					<div class="form-group">
						<label for="thumbnail">缩略图上传</label>
						<script src="{{asset('/admin/fileuplode/js/vendor/jquery.ui.widget.js')}}"></script>
						<script src="{{asset('/admin/fileuplode/js/jquery.iframe-transport.js')}}"></script>
						<script src="{{asset('/admin/fileuplode/js/jquery.fileupload.js')}}"></script>
						<div class="input-group">
						      <span class="input-group-btn">
						        <button class="btn btn-default" type="button" style="background-color:#D0EEFF;padding:0px">
									<a href="javascript:;" class="file" style="margin:0;padding:4px;border:0">选择图片<input id="thumbnail" name="file_upload" type="file"  onchange="gb()"></a>
								</button>
						      </span>
							<input type="text" size="50" class="form-control" name="thumbnail" value="{{$data->thumbnail}}" readonly>
						</div>
						<script type="text/javascript">
							function gb(){layer.load();}
							$("#thumbnail").fileupload({
								url:"{{url('admin/uplode')}}",
								formData:{_token:"{{csrf_token()}}"},
								done:function(e,result){
									layer.closeAll('loading')
									layer.msg('上传成功');
									$('input[name=thumbnail]').val(result.result);
									$('#thumb').show();
									$('#thumb').attr('src',result.result);
								}
							})
						</script>
						<div style="clear: both;"></div>
						@if(empty($data->thumbnail))
							<img id="thumb" src="" style="max-width: 300px; max-height: 200px; margin-top: 15px;" />
							@else
							<img id="thumb" src="{{$data->thumbnail}}" style="max-width: 300px; max-height: 200px; margin-top: 15px;" />
						@endif
					</div>
				</div>
				<!-- 缩略图上传结束 -->
				<div class="col-md-12 sp">
					<div class="form-group">
						<label for="summary">转载视频链接</label>
						<input type="text" size="200" class="form-control" name="url" value="{{$data->url}}" placeholder="只对转载类别有效,原创为空即可">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="summary">是否推荐视频</label>
						<input type="radio" name="recommend" value="1" @if($data->recommend==1) checked @endif>推荐　<input type="radio" name="recommend" value="0" @if($data->recommend==0) checked @endif>不推荐
					</div>
				</div>
				<div class="col-md-12" style="margin:5px;">
					<input type="button" name="button" class="btn" style="float:right;background-color:#00c0ef;color:white;" value="确认提交" onclick="refer()">
				</div>
			</div>
		</form>
	</section>
	<script type="text/javascript">
		@if($data->category_id!=11&& $data->type==0)
		$(function(){$('.sp').hide();})
		function change(num){
			if(num==0){	$('.sp').hide();$('.sps').show();}else{	$('.sps').hide();$('.sp').show();}
		}
		@else
		$(function(){$('.sp').show();})
		@endif
	</script>
	<script type="text/javascript">
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
			if($('input[name=thumbnail]').val()=="")
			{
				    layer.msg('请输入缩略图');
					$('input[name=thumbnail]').focus();
					return false;
			}else{
				$('#frm').submit();
			}
		}
	</script>
@endsection