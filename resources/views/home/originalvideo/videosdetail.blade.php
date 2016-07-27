@extends('home.common.common')
@section('contents')
<!--内容区域-->
<div class="comWidth" style="margin-top:30px;">
    <div class="content clearfix">
        <div class="contentLeft clearfix">
            <div class="article">
                <div class="position long">
                    <span><a href="{{route('originalvideo.index')}}">原创视频&nbsp;</a></span>
                    <span><a href="{{route('originalvideo.lists',array('id'=>$info->category_id))}}">&nbsp;<b>></b>&nbsp;{{category($info->category_id)['name']}}</a></span>
                    <i><a href="javascript:;">&nbsp;<b>></b>&nbsp;正文</a></i>
                </div>
                <div class="video-detail">
                    <div class="video">
                        {{--<embed src="{{$info->url}}" quality="high" width="680" height="400" align="middle" allowScriptAccess="always" allowFullScreen="true" mode="transparent" type="application/x-shockwave-flash"></embed>--}}
                        <iframe frameborder="0" name="Iframe1" src="{{$info->url}}" width="100%" height="100%"></iframe>
                    </div>
                </div>
                <div class="video-description" style="position: relative">
                    <p class="title">{{$info->title}}<span><b>原创</b></span></p>
                    <p class="detail">
                       {{$info->summary}}
                    </p>
                    <div class="tabBox">
                        <ul id="issus" class="tab-title clearfix">
                            @foreach($issues as $k=>$issue)
                              <li @if($info->id==$issue->id) class="tab-active" @endif><a onclick="dianji()" href="{{url('/originalvideo/show/'.$id.'/'.$issue->id)}}">{{$issue->name}}</a></li>
                            @endforeach
                        </ul>
                        @foreach($issues as $k=>$issue)
                         <div class="tab-content">
                              <div class="tab-detail" @if($info->id==$issue->id) style="display:block;" @endif>
                                  <em style="left:@if($k==1) 92px; @else {{$k*80}}px; @endif"></em>
                                 {{$issue->summary}}
                              </div>
                         </div>
                        @endforeach
                    </div>
                    <div style="position:absolute; bottom:20px; right: 20px;">@include('home.common.share')</div>
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
                    <span>相关视频</span>
                </div>
                <ul class="other-Video clearfix">
                    @if(!empty($Xgvideos))
                    @foreach($Xgvideos as $info)
                    <li>
                        <a href="">
                            <div class="video">
                                <img src="{{$info->thumbnail}}">
                                <img class="play" src="{{asset('/home/img/play.png')}}">
                            </div>
                            <p class="description">{{category($info->category_id)['name']}}</p>
                        </a>
                    </li>
                    @endforeach
                   @endif
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function dianji(){
        layer.load(2);
    }
</script>
@endsection
