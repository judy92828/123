@extends('home.common.common')
@section('contents')
    <div class="comWidth">
        <div class="content clearfix">
            <div class="article">
                <div class="articleTitle">
                    <span>{{category('14')['name']}}</span>
                    <i>{{category('14')['alias']}}</i>
                    <a href="{{route('welfare.lists',array('id'=>14))}}">更多详情</a>
                </div>
                <div class="contentLeft-narrow">
                    <!--轮播图-->
                    <div class="carousel">
                        <div id="slider" class="slideBox">
                            <ul class="items">
                                @if(count($flagthumb)>0)
                                    @foreach($flagthumb as $vo)
                                        <li><a href="{{route('welfare.show',array('id'=>$vo->id))}}" title="{{$vo->title}}"><img src="{{$vo->thumbnail}}"></a></li>
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
                                    <a href="{{route('welfare.show',array('id'=>$vo->id))}}">{{$vo->title}}</a>
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
                                        <a href="{{route('welfare.show',array('id'=>$vo->id))}}">{{$vo->title}}</a>
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
                    <span>{{category('15')['name']}}</span>
                    <i>{{category('15')['alias']}}</i>
                    <a href="{{route('welfare.lists',array('id'=>15))}}">更多详情</a>
                </div>
                <ul class="healthJourney clearfix">
                    @if(!empty($jkdata))
                        @foreach($jkdata as $vo)
                            <li>
                                <a href="{{route('welfare.show',array('id'=>$vo->id))}}">
                                    <img src="{{$vo->thumbnail}}">
                                    <div class="text">
                                        <p>{{getSubstr($vo->title,0,13)}}</p>
                                        <p class="details">{{getSubstr($vo->summary,1,50)}}</p>
                                        <div class="date">{{ $vo->created_at->format('Y.m.d') }}<span>{{getSubstr($vo->keywords,0,7)}}</span></div>
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
                        <span>{{category('16')['name']}}</span>
                        <i>{{category('16')['alias']}}</i>
                        <a href="{{route('welfare.lists',array('id'=>16))}}">更多详情</a>
                    </div>
                    @if(!empty($ygdata))
                        @foreach($ygdata as $key=>$vo)
                            <div class="campus clearfix @if($key!=0) borders @endif">
                                <a href="{{route('welfare.show',array('id'=>$vo->id))}}" class="pic"><img src="{{$vo->thumbnail}}"></a>
                                <a href="{{route('welfare.show',array('id'=>$vo->id))}}" class="text">
                                    <p>{{getSubstr($vo->title,0,20)}}</p>
                                    <p class="details">{{getSubstr($vo->summary,0,100)}}</p>
                                    <div class="date">{{ $vo->created_at->format('Y.m.d') }}<span>{{getSubstr($vo->keywords,0,20)}}</span></div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @include('home.common.right')
        </div>
    </div>
@endsection