<div class="right">
    <div class="contentRight">
        <p class="moduleTitle">视频推荐</p>
        @if(!empty($datas['flagvideo']))
            @foreach($datas['flagvideo'] as $vo)
                    @if($vo->category_id==11 || $vo->category_id==12)
                     <a href="{{route('doctor.videoshow',array('id'=>$vo->id))}}">
                    @else
                        <a href="{{route('video.show',array('id'=>$vo->id))}}">
                     @endif
                    <div class="video">
                        <img src="{{$vo->thumbnail}}" style="height: 116px;">
                        <img class="play" src="/home/img/play.png">
                        <div class="videoTitle">{{getSubstr($vo->title,0,15)}}</div>
                    </div>
                </a>
                <div class="description clearfix">
                    <p>{{category($vo->category_id)['name']}}<b>{{mb_substr($vo->summary,0,11,'utf-8')}}...</b></p>
                    <a href="">【详情】</a>
                </div>
                <div class="line">
                    <img src="/home/img/cross.png">
                </div>
            @endforeach
        @endif
    </div>
    <div class="contentRight" style="margin-top:15px;">
        <p class="moduleTitle">热门文章排行榜</p>
        <ul class="articles">
            @if(!empty($datas['redarticle']))
                @foreach($datas['redarticle'] as $key=>$vo)
                    <li><a href="{{route('index.show',array('id'=>$vo->id))}}"><span>{{$key+1}}</span>{{$vo->title}}</a></li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="adver">
        <!--广告位-->
        <div class="advertising"><a href="{{adv(3)['url']}}"><img src="{{adv(3)['thumb']}}" alt="{{adv(3)['title']}}"/></a></div>
    </div>
</div>