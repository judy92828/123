@extends('home.common.common')
@section('contents')
        <!--内容区域-->
<div class="comWidth" style="margin-top:30px;">
    <div class="content clearfix">
        <div class="contentLeft clearfix">
            <div class="article">
                <div class="position long" style="width:340px;">
                    <span><a href="{{route('doctor.index')}}">大医精诚&nbsp;</a></span>
                    <span><a href="{{route('doctor.lists',array('id'=>$info->category_id))}}">&nbsp;<b>></b>&nbsp;{{category($info->category_id)['name']}}&nbsp;</a></span>
                    <i><a href="javascript:;">&nbsp;<b>></b>&nbsp;正文</a></i>
                </div>
                @if(count($info) > 0)
                <div class="video-detail">
                    <div class="video">
{{--                        <embed src="{{$info->url}}" quality="high" width="680" height="400" align="middle" allowScriptAccess="always" allowFullScreen="true" mode="transparent" type="application/x-shockwave-flash"></embed>--}}
                        <iframe frameborder="0" name="Iframe1" src="{{$info->url}}" width="100%" height="100%"></iframe>
                    </div>
                </div>
                <div class="video-description" style="padding-bottom:0; position: relative">
                    <div class="title">{{$info->title}}<span><b>@if($info->type==0) 原创 @else 转载 @endif</b></span>
                        <div class="interview-source"><span>来源：@if(empty($info->source)) 网络 @else {{$info->source}} @endif</span><span style="margin-right:0;">责任编辑：@if(empty($info->author)) 未知 @else {{$info->author}} @endif</span></div>
                    </div>
                    <p class="detail">{!! $info->summary !!}</p>
                    <div style="position:absolute; bottom:20px; right: 20px;">@include('home.common.share')</div>
                </div>
                @endif
                @include('home.common.bottom')
            </div>
        </div>
        @include('home.common.right')
    </div>
    <div class="content clearfix">
        <div class="contentLeft clearfix">
            <div class="article">
                <div class="articleTitle">
                    <span>相关视频</span>
                </div>
                <ul class="other-Video clearfix">
                    @if(!empty($rand))
                        @foreach($rand as $vo)
                            <li>
                                <a href="{{route('doctor.videoshow',array('id'=>$vo->id))}}">
                                    <div class="video">
                                        <img src="{{$vo->thumbnail}}">
                                        <img class="play" src="/home/img/play.png">
                                    </div>
                                    <p class="description">{{$vo->title}}</p>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
    @endsection