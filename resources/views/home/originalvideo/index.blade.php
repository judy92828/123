@extends('home.common.common')
@section('contents')
        <!--内容区域-->
<div class="comWidth">
    <div class="content clearfix">
        <div class="article">
            <div class="articleTitle">
                <span>{{category('6')['name']}}</span>
                <i>{{category('6')['alias']}}</i>
                <a href="{{url('originalvideo/showlist/6')}}">更多详情</a>
            </div>
        </div>
        @if(!empty($video1))
            <div class="video-Left">
                <a href="{{url('/originalvideo/show/'.$video1[0]->id)}}" class="video">
                    <img src="{{$video1[0]->thumbnail}}">
                    <img class="play" src="{{asset('/home/img/play.png')}}">
                    <div class="videoTitle">{{$video1[0]->title}}</div>
                </a>
            </div>
            <div class="video-Right">
                <a href="{{url('/originalvideo/show/'.$video1[1]->id)}}" class="video-article">
                    <p class="title">{{$video1[1]->title}}</p>
                    <p class="video-article-detail">
                        {{getSubstr($video1[1]->summary,0,180)}}
                    </p>
                </a>
                <div class="video-small">
                    <a class="video" href="{{url('/originalvideo/show/'.$video1[2]->id)}}" >
                        <img src="{{$video1[2]->thumbnail}}">
                        <img class="play" src="{{asset('/home/img/play.png')}}">
                        <div class="videoTitle">{{$video1[2]->title}}</div>
                    </a>
                </div>
            </div>
        @endif
    </div>
    <div class="content clearfix">
        <div class="article">
            <div class="articleTitle">
                <span>{{category('7')['name']}}</span>
                <i>{{category('7')['alias']}}</i>
                <a href="{{url('originalvideo/showlist/7')}}">更多详情</a>
            </div>
        </div>
        @if(!empty($video2))
            <div class="video-Left">
                <a class="video" href="{{url('/originalvideo/show/'.$video2[0]->id)}}">
                    <img src="{{$video2[0]->thumbnail}}">
                    <img class="play" src="{{asset('/home/img/play.png')}}">
                    <div class="videoTitle">{{$video2[0]->title}}</div>
                </a>
            </div>
            <div class="video-Right">
                <a class="video-article" href="{{url('/originalvideo/show/'.$video2[1]->id)}}">
                    <p class="title">{{$video2[1]->title}}</p>
                    <p class="video-article-detail">
                        {{getSubstr($video2[1]->summary,0,180)}}
                    </p>
                </a>
                <div class="video-small">
                    <a class="video" href="{{url('/originalvideo/show/'.$video2[2]->id)}}">
                        <img src="{{$video2[2]->thumbnail}}">
                        <img class="play" src="{{asset('/home/img/play.png')}}">
                        <div class="videoTitle">{{$video2[2]->title}}</div>
                    </a>
                </div>
            </div>
        @endif
    </div>
    <div class="content clearfix">
        <div class="article">
            <div class="articleTitle">
                <span>{{category('8')['name']}}</span>
                <i>{{category('8')['alias']}}</i>
                <a href="{{url('originalvideo/showlist/8')}}">更多详情</a>
            </div>
        </div>
        @if(!empty($video3))
            <div class="video-Left">
                <a class="video" href="{{url('/originalvideo/show/'.$video3[0]->id)}}">
                    <img src="{{$video3[0]->thumbnail}}">
                    <img class="play" src="{{asset('/home/img/play.png')}}">
                    <div class="videoTitle">{{$video3[0]->title}}</div>
                </a>
            </div>
            <div class="video-Right">
                <a class="video-article" href="{{url('/originalvideo/show/'.$video3[1]->id)}}">
                    <p class="title">{{$video3[1]->title}}</p>
                    <p class="video-article-detail">
                        {{getSubstr($video3[1]->summary,0,180)}}
                    </p>
                </a>
                <div class="video-small">
                    <a class="video" href="{{url('/originalvideo/show/'.$video3[2]->id)}}">
                        <img src="{{$video3[2]->thumbnail}}">
                        <img class="play" src="{{asset('/home/img/play.png')}}">
                        <div class="videoTitle">{{$video3[2]->title}}</div>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection