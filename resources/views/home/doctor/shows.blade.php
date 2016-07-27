@extends('home.common.common')
@section('contents')
        <!--内容区域-->
<div class="comWidth" style="margin-top:30px;">
    <div class="content clearfix">
        <div class="article">
            <div class="position long">
                <span><a href="{{route('doctor.index')}}">大医精诚&nbsp;</a></span>
                <span><a href="{{route('doctor.lists',array('id'=>$info->category_id))}}" >&nbsp;<b>></b>&nbsp;{{category($info->category_id)['name']}}&nbsp;</a></span>
                <i><a href="javascript:;">&nbsp;<b>></b>&nbsp;正文</a></i>
            </div>
            <div class="physician-post">
                <img src="{{$info->image}}">
                <div class="text">
                    <p>{{$info->title}}</p>
                    <div class="detail">{!! $info->summary !!}</div>
                </div>
            </div>
        </div>
        <div class="contentLeft clearfix">
            <div class="newsdetails" style="border-bottom:none;">
                <div class="title">{{$info->title}}</div>
                <p style="color:#322c2c;">{!! $info->content !!}</p>
            </div>
            @include('home.common.bottom')
        </div>
        @include('home.common.right')
    </div>
</div>
    @endsection