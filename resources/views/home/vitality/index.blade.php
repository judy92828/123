@extends('home.common.common')
@section('contents')
    <div class="comWidth">
        <div class="content clearfix">
            <div class="article">
                <div class="articleTitle">
                    <span>{{category('2')['name']}}</span>
                    <i>{{category('2')['alias']}}</i>
                    <a href="{{route('vitality.lists',array('id'=>2))}}">更多详情</a>
                </div>
                <div class="contentLeft-narrow">
                    <!--轮播图-->
                    <div class="carousel">
                        <div id="slider" class="slideBox">
                            <ul class="items">
                                @if(count($flagthumb)>0)
                                    @foreach($flagthumb as $vo)
                                        <li><a href="{{route('vitality.show',array('id'=>$vo->id))}}" title="{{$vo->title}}"><img src="{{$vo->thumbnail}}"></a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="contentRight-narrow">
                    <div class="healthArticle">
                        @if(!empty($twodata))
                            @foreach($twodata as $vo)
                                <div class="others">
                                    <a href="{{route('vitality.show',array('id'=>$vo->id))}}">{{$vo->title}}</a>
                                    <p class="details">{{getSubstr($vo->summary,0,80)}}</p>
                                </div>
                                <div class="line">
                                    <img src="{{asset('/home/img/cross.png')}}">
                                </div>
                            @endforeach
                        @endif
                        <div class="otherBox">
                            <div class="others">
                                @if(!empty($threedata))
                                    @foreach($threedata as $vo)
                                        <a href="{{route('vitality.show',array('id'=>$vo->id))}}">{{$vo->title}}</a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content clearfix">
            <div class="article">
                <div class="articleTitle">
                    <span>{{category('3')['name']}}</span>
                    <i>{{category('3')['alias']}}</i>
                    <a href="{{route('vitality.lists',array('id'=>3))}}">更多详情</a>
                </div>
                <ul class="healthJourney clearfix">
                    @if(!empty($jkdata))
                        @foreach($jkdata as $vo)
                            <li>
                                <a href="{{route('vitality.show',array('id'=>$vo->id))}}">
                                    <img src="{{$vo->thumbnail}}">
                                    <div class="text">
                                        <p>{{getSubstr($vo->title,0,13)}}</p>
                                        <p class="details">{{getSubstr($vo->summary,0,50)}}</p>
                                        <div class="date">{{ $vo->created_at->format('Y.m.d') }}<span>{{getSubstr($vo->keywords,0,6)}}</span></div>
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
                        <span>{{category('4')['name']}}</span>
                        <i>{{category('4')['alias']}}</i>
                        <a href="{{route('vitality.lists',array('id'=>4))}}">更多详情</a>
                    </div>
                    @if(!empty($ygdata))
                        @foreach($ygdata as $key=>$vo)
                            <div class="campus clearfix @if($key!=0) borders @endif">
                                <a href="{{route('vitality.show',array('id'=>$vo->id))}}" class="pic"><img src="{{$vo->thumbnail}}"></a>
                                <a href="{{route('vitality.show',array('id'=>$vo->id))}}" class="text">

                                    <p>{{getSubstr($vo->title,0,15)}}</p>
                                    <p class="details">{{getSubstr($vo->summary,0,90)}}</p>

                                    <div class="date">{{ $vo->created_at->format('Y.m.d') }}<span>{{getSubstr($vo->keywords,0,15)}}</span></div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @include('home.common.right')
        </div>
        @if(count($channel) >0 )
        <div class="content clearfix">
            <div class="article">
                <div class="articleTitle">
                    <span>地方频道</span>
                    <i>LOCAL CHANNEL</i>
                </div>
                <div class="channel">
                    <ul class="clearfix">

                            @foreach($channel as $vo)
                                <li><a href="{{$vo->url}}">{{$vo->title}}</a></li>
                            @endforeach

                    </ul>
                </div>
                <p class="expect">正在待建中 敬请期待...</p>
            </div>
        </div>
       @endif
    </div>
@endsection