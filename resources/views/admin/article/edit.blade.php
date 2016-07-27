@extends('admin.common.common')
@section('contentes')
	<script charset="utf-8" src="{{asset('/admin/kindeditor/kindeditor-all-min.js')}}"></script>
	<script charset="utf-8" src="{{asset('/admin/kindeditor/lang/zh-CN.js')}}"></script>
	<script type="text/javascript">
		var editor;
		KindEditor.ready(function(K) {
			editor = K.create('textarea[name="content"]', {
				allowFileManager : true,
				afterBlur: function(){this.sync();}
			})
		});
	</script>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">修改文章</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
          	 <form class="form" style="padding:15px;margin-top:10px">
			   <div class="row">
		  	<div class="col-md-6">
		  	  <div class="form-group">
		  	     <label for="category_id">文章分类</label>
		  	     <select class="form-control" name="category_id" id="category_id" onchange="change(this.options[this.options.selectedIndex].value)">
		  	     	 @foreach($cates as $cate)
				         	<option @if($article->category_id==$cate->id) selected @endif value="{{ $cate->id }}">{{ $cate->name }}</option>
				     @endforeach
		  	     </select>
		  	  </div>
		  	</div>
		  	<div class="col-md-5">
		  	  <div class="form-group">
		  	     <label for="title">文章标题</label>
		  	     <input type="text" class="form-control" id="title" name="title" value="{{$article->title}}" >
		  	  </div>
		  	</div>
		  	<div class="col-md-6">
		  	  <div class="form-group">
		  	     <label for="keywords">关键字</label>
		  	     <input type="text" class="form-control" id="keywords" name="keywords" value="{{$article->keywords}}" >
		  	  </div>
		  	</div>
		  	<div class="col-md-5">
		  	  <div class="form-group">
		  	     <label for="source">文章来源</label>
		  	     <input type="text" class="form-control" id="source" name="source" value="{{$article->source}}" >
		  	  </div>
		  	</div>
		  	<div class="col-md-11">
		  	  <div class="form-group">
		  	     <label for="summary">文章摘要</label>
		  	     <textarea class="form-control" id="summary" name="summary" rows="4" value="">{{$article->summary}}</textarea>
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
						        	<a href="javascript:;" class="file" style="margin:0;padding:4px;border:0">选择图片<input id="thumbnail" name="file_upload" type="file"></a>
						        </button>
						      </span>
						      <input type="text" size="50" class="form-control" name="thumbnail" value="{{$article->thumbnail}}" readonly>
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
                         <img id="thumb" src="{{$article->thumbnail}}" style="max-width: 300px; max-height: 200px; margin-top: 15px;" />
		  	  		</div>
		  		</div>
		  	<!-- 缩略图上传结束 -->
		  	<!-- 大图上传 -->
		  		<div class="col-md-6">
		  			<div class="form-group">
		  	    		 <label for="image">大图上传</label>
                         <div class="input-group">
						      <span class="input-group-btn">
						        <button class="btn btn-default" type="button" style="background-color:#D0EEFF;padding:0px">
						        	<a href="javascript:;" class="file" style="margin:0;padding:4px;border:0">选择图片<input id="image" name="file_upload" type="file"></a>
						        </button>
						      </span>
						      <input type="text" class="form-control" name="image"  value="{{$article->image}}" readonly>
					     </div>
					     <script type="text/javascript">
                            $("#image").fileupload({
                                url:"{{url('admin/uplode')}}",
                                formData:{"_token":"{{csrf_token()}}"},
                                done:function(e,result){
                                    $('input[name=image]').val(result.result);
                                    $('#img').show();
                                    $('#img').attr('src',result.result);
                                }
                            })
                         </script>
                         <div style="clear: both;"></div>
                         <img id="img" src="{{$article->image}}" style="max-width: 400px; max-height: 300px; margin-top: 15px;" />
		  	  		</div>
		  		</div>
				   <div class="col-md-12 syflag" @if(category($article->category_id)['parent_id']==9) style="display: none;" @endif>
					   <div class="form-group">
						   <label for="summary">推荐到首页</label>
						   <input type="radio" name="recommend"   value="1" @if($article->recommend==1) checked @endif>推荐　<input type="radio" name="recommend"  value="0" @if($article->recommend==0) checked @endif>不推荐
					   </div>
				   </div>
		  	<!-- 富文本编辑器 -->
		  		<div class="col-md-11">
		  			<textarea name="content" id="myEditor" style="width: 100%; height: 400px;">{{$article->content}}</textarea>
				</div>
			<!-- 富文本编辑器结束 -->
			   <div class="col-md-12" style="margin:5px;">
			   		<input type="button" name="button" class="btn" style="float:right;background-color:#00c0ef;color:white;" value="确认提交" onclick="refer({{$article->id}})">
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
		function change(num){
			layer.load(2);
			$.post("{{route('news.index')}}",
					{
						'_token':'{{csrf_token()}}',
						id:num
					},
					function(data,status){
						if(data==9){
							layer.closeAll('loading');
							$('.syflag').hide();
						}else{
							layer.closeAll('loading');
							$('.syflag').show();
						}
					});
		}
		function refer(at_id)
		{
			var editor=KindEditor.create('#myEditor');
			var html=editor.html();
			var data = {};
			data['content'] = {};
			data['content']['category_id'] = $("select option:selected").val();
			data['content']['title'] = $('#title').val();
			data['content']['recommend'] = $("input[name='recommend']:checked").val();
			if($('#title').val()=="")
			{
				    layer.msg('请输入文章标题');
					$('#title').focus();
					return false;
			}
			data['content']['summary'] = $('#summary').val();
			if($('#summary').val()=="")
			{
				    layer.msg('请输入文章标题');
					$('#summary').focus();
					return false;
			}
			data['content']['keywords'] = $('#keywords').val();
			data['content']['source'] = $('#source').val();
			data['content']['content'] = html;
			if(html==""){
				    layer.msg('请输入文章内容');
					$('#myEditor').focus();
					return false;
			}
			data['content']['thumbnail'] = $('input[name=thumbnail]').val();
			if($('input[name=thumbnail]').val()=="")
			{
				    layer.msg('请输入缩略图');
					$('input[name=thumbnail]').focus();
					return false;
			}
			data['content']['image'] = $('input[name=image]').val();
			data['_token'] = "{{ csrf_token() }}";
			data['_method']="put";
			console.log(data);
			layer.load();
			$.post("{{url('admin/article/')}}/"+at_id,data,function(msg){
				if(msg.status==0)
					layer.closeAll('loading');
					layer.msg(msg.errorMsg, {icon: 5});
				if(msg.status==1){
					layer.closeAll('loading');
					layer.msg(msg.errorMsg, {icon: 6});
					location.href = "{{url('admin/article/')}}";
				}
			},"json");
		}
	</script>
@endsection