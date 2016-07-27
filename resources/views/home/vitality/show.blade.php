@extends('home.common.common')

@section('contents')
        <!--内容区域-->
<div class="comWidth" style="margin-top:30px;">
    <div class="content clearfix">
        <div class="contentLeft clearfix">
            <div class="article">
                <div class="position long">
                    <span><a href="{{route('vitality.index')}}">活力四川&nbsp;</a></span>
                    <span><a href="{{route('vitality.lists',array('id'=>$info->category_id))}}">&nbsp;<b>></b>&nbsp;{{category($info->category_id)['name']}}&nbsp;</a></span>
                    <i><a href="javascript:;">&nbsp;<b>></b>&nbsp;正文</a></i>
                </div>
                <div class="newsContent">
                    <p>{{$info->title}}</p>
                    <div class="date">
                        <span>{{ $info->created_at->format('Y年m月d日 H时i分s秒') }}发布</span>
                        <b>来源: @if(empty($info->source))网络@else{{$info->source}}@endif</b>
                    </div>
                </div>
                <div class="newsdetails">
                    <p>{!! $info->content !!}</p>
                    <div class="editor">责任编辑： {{$info->author}}</div>
                </div>
                @include('home.common.bottom')
            </div>
        </div>
        @include('home.common.right')
    </div>
    <div class="content clearfix">
        <div class="contentLeft clearfix">
            <div class="article">
                <div class="articleTitle">
                    <span>相关文章</span>
                </div>
                <div class="otherBox sunshine" style="margin-bottom:20px;">
                    <div class="others clearfix">
                        @if(!empty($xgdata))
                            @foreach($xgdata as $vo)
                                <a href="{{route('vitality.show',array('id'=>$vo->id))}}" >{{getSubstr($vo->title,0,17)}}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection