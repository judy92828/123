@extends('home.common.common')
@section('contents')
<!--内容区域-->
<div class="comWidth" style="margin-top:30px;">
    <div class="content clearfix">
        <div class="contentLeft clearfix">
            <div class="article">
                <div class="position">
                    <span><a href="{{route('originalvideo.index')}}">原创视频&nbsp;</a></span>
                    <span><a href="{{route('originalvideo.lists',array('id'=>$title))}}" style="line-height:44px;">&nbsp;<b>></b>{{category($title)['name']}}&nbsp;</a></span>
                </div>
                @foreach($videos as $key=>$video)
                <div class="campus clearfix @if($key!=0) borders @endif">
                    <a href="{{url('/originalvideo/show/'.$video->id)}}" class="pic"><img src="{{$video->thumbnail}}"></a>
                    <a href="{{url('/originalvideo/show/'.$video->id)}}" class="text">
                        <p>{{$video->title}}</p>
                        <p class="details">
                           {{getSubstr($video->summary,0,100)}}
                        </p>
                        <div class="date">{{$video->created_at->format('Y.m.d')}}<span>{{$video->keywords}}</span></div>
                    </a>
                </div>
              @endforeach
            </div>
        </div>
        @include('home.common.right')
    </div>
    <div class="page">
       {{$videos->links()}}
    </div>
</div>
@endsection