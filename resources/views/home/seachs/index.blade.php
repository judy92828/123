@extends('home.common.header')
@section('contents')
        <!--内容区域-->
<div class="comWidth" style="margin-top:30px;">
    <div class="content clearfix">
        <div class="contentLeft clearfix">
            <div class="article">
                <div class="position">
                    <span><a href="{{route('index.index')}}">首页&nbsp;</a></span>
                    <i><a href="javascript:;">&nbsp;<b>></b>&nbsp;搜索<span style="color: red;font-weight: bold; padding: 0px 5px;">{{$keywords}}</span>的结果</a></i>
                </div>
                @if(!empty($data))
                    @foreach($data as $vo)
                        <?php $date=getinfo($vo->id,$vo->type);?>
                        @if($date!=null)
                        <div class="campus clearfix" style="padding-top:0;">
                            <a href="@if($vo['type']==0) {{route('index.show',array('id'=>$vo->id))}} @else {{url('/originalvideo/show/'.$vo->id)}} @endif" class="pic"><img src="{{$date['thumbnail']}}"></a>
                            <a href="@if($vo['type']==0) {{route('index.show',array('id'=>$vo->id))}} @else {{url('/originalvideo/show/'.$vo->id)}} @endif" class="text">
                                <p>{{$vo->title}}</p>
                                <p class="details">{{$date['summary']}}</p>
                                <div class="date">{{ $vo->created_at}}发布</div>
                            </a>
                        </div>
                            @endif
                    @endforeach
                @endif
            </div>
        </div>
        @include('home.common.right')
    </div>
    <div class="page">
        {!! $data->appends(['keywords'=>$keywords])->render() !!}
    </div>
</div>
@endsection