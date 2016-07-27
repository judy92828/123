@extends('home.common.common')
@section('contents')
        <!--内容区域-->
<div class="comWidth" style="margin-top:30px;">
    <div class="content clearfix">
        <div class="contentLeft clearfix">
            <div class="article">
                <div class="position" style="width:242px;">
                    <span><a href="{{route('doctor.index')}}">大医精诚&nbsp;</a></span>
                    <i><a href="javascript:;">&nbsp;<b>></b>&nbsp;{{category($title)['name']}}</a></i>
                </div>
                <div class="health-interview high clearfix" style="margin-bottom:-20px;">
                    @if(!empty($lists))
                        @foreach($lists as $vo)
                            <div class="interview">
                                <a href="{{route('doctor.videoshow',array('id'=>$vo->id))}}">
                                    <div class="video">
                                        <img src="{{$vo->thumbnail}}">
                                        <img class="play" src="{{asset('/home/img/play.png')}}">
                                        <div class="videoTitle">{{getSubstr($vo->title,0,10)}}</div>
                                    </div>
                                    <p class="interview-words">{{$vo->summary}}</p>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!--广告位-->
                @include('home.common.bottom')
            </div>
        </div>
        @include('home.common.right')
    </div>
    <div class="page">
        {{$lists->links()}}
    </div>
</div>
    @endsection