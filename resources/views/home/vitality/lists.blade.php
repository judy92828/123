@extends('home.common.common')
@section('contents')
    <!--内容区域-->
    <div class="comWidth" style="margin-top:30px;">
        <div class="content clearfix">
            <div class="contentLeft clearfix">
                <div class="article">
                    <div class="position">
                        @if(is_object($cat))
                        <span>@if(category($cat->parent_id)) <a href="{{route(getRoute($cat->parent_id).'.index')}}"> {{category($cat->parent_id)['name']}} </a> @else <a href="{{route('index.index')}}"> 首页 </a> @endif &nbsp;</span>
                        <i><a href="">&nbsp;<b>></b>&nbsp;{{category($title)['name']}}</a></i>
                            @endif
                    </div>
                    @foreach($articles as $key=>$article)
                        <div class="campus clearfix @if($key!=0) borders @endif">
                            <a href="{{url('/show/'.$article->id)}}" class="pic"><img src="{{$article->thumbnail}}"></a>
                            <a href="{{url('/show/'.$article->id)}}" class="text">
                                <p>{{$article->title}}</p>
                                <p class="details">
                                    {{getSubstr($article->summary,0,80)}}
                                </p>
                                <div class="date">{{ $article->created_at->format('Y.m.d') }}<span>{{getSubstr($article->keywords,0,15)}}</span></div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @include('home.common.right')
        </div>
        <div class="page">
            {{$articles->links()}}
        </div>
    </div>
@endsection