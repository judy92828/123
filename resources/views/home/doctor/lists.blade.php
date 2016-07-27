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
                <ul class="physician-list mien clearfix">
                    @if(!empty($lists))
                        @foreach($lists as $vo)
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