@extends('home.common.common')
@section('contents')
        <!--内容区域-->
<div class="comWidth">
    <div class="content clearfix">
        <div class="article">
            <div class="articleTitle">
                <span>{{category('10')['name']}}</span>
                <i>{{category('10')['alias']}}</i>
                <a href="{{route('doctor.lists',array('id'=>10))}}">更多详情</a>
            </div>
            <ul class="physician-list clearfix">
                @if(!empty($ysdata))
                    @foreach($ysdata as $vo)
                        <li>
                            <a href="{{route('doctor.show',array('id'=>$vo->id))}}">
                                <div class="photo">
                                    <img src="{{$vo->thumbnail}}">
                                    <div class="photo-tip">{{getSubstr($vo->summary,0,10)}}<span>【详情】</span></div>
                                </div>
                                <div class="text">
                                    <p>{{$vo->title}}</p>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="content clearfix">
        <div class="contentLeft clearfix">
            <div class="article">
                <div class="articleTitle">
                    <span>{{category('11')['name']}}</span>
                    <i>{{category('11')['alias']}}</i>
                    <a href="{{route('doctor.lists',array('id'=>11))}}">更多详情</a>
                </div>
                <div class="health-interview clearfix">
                    @if(!empty($jkdata))
                        @foreach($jkdata as $vo)
                            <div class="interview">
                                <a href="{{route('doctor.videoshow',array('id'=>$vo->id))}}">
                                    <div class="video">
                                        <img src="{{$vo->thumbnail}}" style="width: 330px; height: 178px;;">
                                        <img class="play" src="{{asset('/home/img/play.png')}}">
                                        <div class="videoTitle">{{$vo->title}}</div>
                                    </div>
                                    <p class="interview-words">{{$vo->summary}}</p>
                                </a>
                            </div>
                        @endforeach
                    @endif
                    @if(!is_null(adv(4)))
                    <div class="interview" >
                        <!--广告位-->
                        <div class="advertising">
                            <a href="{{adv(4)['url']}}"><img src="{{adv(4)['thumb']}}" alt="{{adv(4)['title']}}" /></a>
                        </div>
                    </div>
                        @endif
                        @if(!is_null(adv(4)))
                    <div class="interview" style="margin-right:0;">
                        <!--广告位-->
                        <div class="advertising">
                            <a href="{{adv(4)['url']}}"><img src="{{adv(4)['thumb']}}" alt="{{adv(4)['title']}}"/></a>
                        </div>
                    </div>
                            @endif
                </div>
            </div>
            <div class="article">
                <div class="articleTitle">
                    <span>{{category('12')['name']}}</span>
                    <i>{{category('12')['alias']}}</i>
                    <a href="{{route('doctor.lists',array('id'=>12))}}">更多详情</a>
                </div>
                <ul class="physician-list experts clearfix">
                    @if(!empty($zjdata))
                        @foreach($zjdata as $vo)
                            <li>
                                <a href="{{route('doctor.videoshow',array('id'=>$vo->id))}}">
                                    <div class="photo" style="position: relative;">
                                        <img src="{{$vo->thumbnail}}">
                                        <img class="plays" src="{{asset('/home/img/play.png')}}" style="width: 38px; height: auto;;">
                                        <div class="photo-tip">{{getSubstr($vo->title,0,15)}}</div>
                                    </div>
                                    <p class="details">{{getSubstr($vo->summary,0,45)}}</p>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        @include('home.common.right')
    </div>
</div>
@endsection