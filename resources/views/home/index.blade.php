@extends('home.common.header')
@section('contents')
<div class="comWidth">
    <div class="content clearfix">
        <div class="contentLeft contentLefts">
            @if(!empty($datas['advtext']))
                @foreach($datas['advtext'] as $vo)
                    <p class="adlet" ><a  href="{{$vo->url}}" target="_blank">{{$vo->title}}</a></p>
                @endforeach
            @endif
            <!--轮播图-->
            <div class="carousel">
                <div id="slider" class="slideBox" style="height: 0px;">
                    <ul class="items">
                        @foreach($articles as $article)
                          <li><a href="{{$article->url}}" title="{{$article->title}}"><img src="{{$article->thumb}}" style="width: 680px; height: 375px;"></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="contentRight">
                <p class="moduleTitle">视频推荐</p>
                @if(!empty($datas['flagvideo']))
                    @foreach($datas['flagvideo'] as $key=>$vo)
                        {{--如果是大医精诚中的专家说和健康访谈--}}
                         @if($vo->category_id==11 || $vo->category_id==12)
                             <a href="{{route('doctor.videoshow',array('id'=>$vo->id))}}">
                          @else
                              <a href="{{route('video.show',array('id'=>$vo->id))}}">
                          @endif
                            <div class="video">
                                <img src="{{$vo->thumbnail}}" style="width: 270px; height: 115px;">
                                <img class="play" src="{{asset('/home/img/play.png')}}">
                                <div class="videoTitle">{{getSubstr($vo->title,0,15)}}</div>
                            </div>
                        </a>
                        <div class="description clearfix">
                            <p>{{category($vo->category_id)['name']}}<b>{{mb_substr($vo->summary,0,11,'utf-8')}}...</b></p>
                            <a href="{{url('/originalvideo/show/'.$vo->id)}}">【详情】</a>
                        </div>
                    @if($key==0)
                        <div class="line">
                            <img src="{{asset('/home/img/cross.png')}}">
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="content clearfix">
        <div class="contentLeft">
            <div class="article">
                <div class="articleTitle">
                    <span>{{category('17')['name']}}</span>
                    <i>{{category('17')['alias']}}</i>
                    <a href="{{url('/showlist/17')}}">更多+</a>
                </div>
               @if(count($news)>0)
                <div class="articleContent clearfix">
                    <a href="{{url('/show/'.$bgnew->id)}}" class="pic"><img src="{{$bgnew->thumbnail}}"></a>
                    <div class="words">
                        <p><a href="{{url('/show/'.$bgnew->id)}}">{{getSubstr($bgnew->title,0,18)}}</a></p>
                        <p class="details">
                            {{$bgnew->summary}}
                            <a href="{{url('/show/'.$bgnew->id)}}">【详情】</a>
                        <p>
                    </div>
                    <!--</a>-->
                </div>
                <div class="otherBox">
                    <div class="others clearfix">
                        @foreach($news as $new)
                        <a href="{{url('/show/'.$new->id)}}" class="left">{{getSubstr($new->title,0,40)}}</a>
                       @endforeach
                    </div>
                </div>
              @endif
            </div>

            <div class="article">
                <div class="articleTitle">
                    <span>{{category('18')['name']}}</span>
                    <i>{{category('18')['alias']}}</i>
                    <a href="{{url('/showlist/18')}}">更多+</a>
                </div>
              @if(count($health)>0)
                <div class="articleContent clearfix">
                    <!--<a class="clearfix" href="">-->
                    <a href="{{url('/show/'.$bghealth->id)}}" class="pic"><img src="{{$bghealth->thumbnail}}"></a>
                    <div class="words">
                        <p><a href="{{url('/show/'.$bghealth->id)}}">{{$bghealth->title}}</a></p>
                        <p class="details">
                            {{$bghealth->summary}}
                            <a href="{{url('/show/'.$bghealth->id)}}">【详情】</a>
                        <p>
                    </div>
                    <!--</a>-->
                </div>
                <div class="otherBox" style="margin-bottom:20px;">
                    <div class="others clearfix">
                        @foreach($health as $he)
                        <a href="{{url('/show/'.$he->id)}}" class="left">{{$he->title}}</a>
                        @endforeach
                    </div>
                </div>
              @endif
            </div>
            @include('home.common.bottom')
        </div>
        <div class="right">
            <div class="contentRight">
                <a href="{{route('vitality.index')}}" class="moduleTitle">{{category('1')['name']}}</a>
                <div class="commend">
                    <p>{{category('2')['name']}}</p>
              @if(count($flagthumb)>0)
                  @foreach($flagthumb as $k=>$data)
                     @if($k==0)
                      <a href="{{url('/vitality/'.$data->id.'/show')}}">
                         <div class="video">
                            <img src="{{$data->thumbnail}}" style="height: 150px;">
                            <div class="videoTitle">{{getSubstr($data->title,0,15)}}</div>
                        </div>
                     </a>
                     <div class="description clearfix">
                        <p><b class="long"><?php echo getSubstr($data->summary,0,18); ?></b></p>
                        <a href="{{url('/vitality/'.$data->id.'/show')}}">【详情】</a>
                    </div>
                   @else
                    <div class="line">
                        <img src="{{asset('/home/img/cross.png')}}">
                    </div>
                    <div class="others">
                        <a href="{{url('/vitality/'.$data->id.'/show')}}">{{$data->title}}</a>
                        <div class="description clearfix" style="margin-top:0;">
                            <p><b class="long"><?php echo getSubstr($data->summary,0,18); ?></b></p>
                            <a href="{{url('/vitality/'.$data->id.'/show')}}">【详情】</a>
                        </div>
                    </div>
                    @endif
                   @endforeach
                 @endif
                </div>
            </div>
            <div class="contentRight" style="border-top:none;">
                <div class="commend">
                    <p>{{category('3')['name']}}</p>
                @if(count($jkdata)>0)
                    @foreach($jkdata as $k=>$data)
                        @if($k==0)
                            <a href="{{url('/vitality/'.$data->id.'/show')}}">
                                <div class="video">
                                    <img src="{{$data->thumbnail}}" style="height: 150px;">
                                    <div class="videoTitle"><?php echo getSubstr($data->title,0,15); ?></div>
                                </div>
                            </a>
                            <div class="description clearfix">
                                <p><b class="long"><?php echo getSubstr($data->summary,0,18); ?></b></p>
                                <a href="{{url('/vitality/'.$data->id.'/show')}}">【详情】</a>
                            </div>
                        @else
                            <div class="line">
                                <img src="{{asset('/home/img/cross.png')}}">
                            </div>
                            <div class="others">
                                <a href="{{url('/vitality/'.$data->id.'/show')}}">{{$data->title}}</a>
                                <div class="description clearfix" style="margin-top:0;">
                                    <p><b class="long"><?php echo getSubstr($data->summary,0,18); ?></b></p>
                                    <a href="{{url('/vitality/'.$data->id.'/show')}}">【详情】</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                  @endif
                </div>
            </div>
        </div>
    </div>
    <div class="content clearfix">
        <div class="contentLeft">
            <div class="border clearfix" style="padding-bottom:19px">
                <p class="moduleTitle">{{category('10')['name']}}</p>
                <a href="{{url('/doctor/10')}}">更多详情</a>
                <ul class="physician clearfix">
                 @if(count($ysdata)>0)
                    @foreach($ysdata as $ys)
                    <li>
                        <a href="{{url('/doctor/'.$ys->id.'/show')}}">
                            <img src="{{$ys->thumbnail}}">
                            <div class="videoTitle">{{getSubstr($ys->title,0,10)}}</div>
                        </a>
                    </li>
                   @endforeach
                  @endif
                </ul>
            </div>
        </div>
        <div class="right">
            <!--广告位-->
            <div class="advertising" style="margin-top: 0px;">
                <a href="{{adv(3)['url']}}"><img src="{{adv(3)['thumb']}}" alt="{{adv(3)['title']}}"/></a>
            </div>
        </div>
    </div>

    <div class="content clearfix">
        <div class="border wide">
            <p class="moduleTitle">{{category('11')['name']}}</p>
            <a href="{{url('/doctor/11')}}">更多详情</a>
            <ul class="interview clearfix">
               @if(count($hlinterview)>0)
                @foreach($hlinterview as $data)
                <li class="clearfix">
                    <a href="{{url('/doctor/'.$data->id.'/videoshow')}}">
                        <div class="video left">
                            <img style=" width: 245px; height: 180px;" src="{{$data->thumbnail}}">
                            <img class="play" style="top:40%;" src="{{asset('/home/img/play.png')}}">
                            <div class="videoTitle" style="text-align:center;text-indent: 0;">{{$data->title}}</div>
                        </div>
                    </a>
                    <a href="{{url('/doctor/'.$data->id.'/videoshow')}}" class="words right">
                        <p>{{getSubstr($data->title,0,10)}}</p>
                        <p class="details">
                            {{getSubstr($data->summary,0,90)}}
                        </p>
                    </a>
                </li>
               @endforeach
             @endif
            </ul>
        </div>
    </div>

    <div class="content clearfix">
        <div class="contentLeft">
            <div class="border clearfix">
                <p class="moduleTitle">{{category('13')['name']}}</p>
                <a href="{{route('welfare.index')}}">更多详情</a>
                <div class="health clearfix">
                    @if(count($bgpublichealth)>0)
                    <div class="left">
                        <a href="{{url('/welfare/'.$bgpublichealth->id.'/show')}}" class="video">
                            <img src="{{$bgpublichealth->thumbnail}}" style="height: 197px;">
                            <div class="videoTitle">{{$bgpublichealth->title}}</div>
                        </a>
                        <div class="description clearfix">
                            <p><b class="long">{{getSubstr($bgpublichealth->summary,0,20)}}</b></p>
                            <a href="{{url('/welfare/'.$bgpublichealth->id.'/show')}}">【详情】</a>
                        </div>
                    </div>
                    @endif
                    <!--<div class="vertical" style="float:left;">-->
                    <!--<img src="img/vertical.png">-->
                    <!--</div>-->
                    @if(count($publichealth)>0)
                    <div class="healthArticle">
                      @foreach($publichealth as $pl)
                        <div class="others">
                            <a href="{{url('/show/'.$pl->id)}}">{{$pl->title}}</a>
                            <p class="details" style="height:auto;">
                                {{getSubstr($pl->summary,0,50)}}
                            </p>
                        </div>
                      @endforeach
                    </div>
                        @endif
                </div>
            </div>
        </div>
        <div class="right">
            <div class="contentRight" style="padding-bottom:4px;">
                <p class="moduleTitle">专题活动</p>
                <ul class="activity">
                    <li><a href=""><img class="triangle" src="{{asset('/home/img/triangle.png')}}">这里放一张图片</a></li>
                    <li><a href=""><img class="triangle" src="{{asset('/home/img/triangle.png')}}">健康之旅活动</a></li>
                    <li><a href=""><img class="triangle" src="{{asset('/home/img/triangle.png')}}">中医科技大会</a></li>
                    <li><a href=""><img class="triangle" src="{{asset('/home/img/triangle.png')}}">全国中医校长论坛</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection