@extends('home.common.common')
@section('contents')

<!--内容区域-->
<div class="comWidth" style="margin-top:30px;">
    <div class="content clearfix">
        <div class="contentLeft clearfix">
            <div class="article">
                <div class="position long">
                    <span>@if(category($cat->parent_id)) <a href="{{route(getRoute($cat->parent_id).'.index')}}"> {{category($cat->parent_id)['name']}} </a> @else <a href="{{route('index.index')}}"> 首页 </a> @endif &nbsp;</span>
                    <span>@if(category($cat->parent_id)) <a href="{{route(getRoute($cat->parent_id).'.lists',array('id'=>$info->category_id))}}"> @else <a href="{{url('/showlist/'.$info->category_id)}}"> @endif &nbsp;<b>></b>&nbsp;{{$cat->name}}</a> </span>
                    <i><a href="javascript:">&nbsp;<b>></b>&nbsp;正文</a></i>
                </div>
                <div class="newsContent">
                    <p>{{$info->title}}</p>
                    <div class="date">

                        <span>{{ $info->created_at->format('Y.m.d H:i:s') }}</span>
                        <b>来源: @if(empty($info->source))网络@else{{$info->source}}@endif</b>
                    </div>
                </div>
                <div class="newsdetails">
                    <p>
                        {!! $info->content !!}
                    </p>
                    <div class="editor">责任编辑：{{$info->author}}

                        @include('home.common.share')
                    </div>
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
                                <a href="{{route('index.show',array('id'=>$vo->id))}}" >{{getSubstr($vo->title,0,17)}}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection