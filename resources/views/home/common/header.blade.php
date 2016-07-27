<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title>{{$datas['system']['webtitle']}}</title>
    <meta name="keywords" content="{{$datas['system']['keywords']}}" />
    <meta name="description" content="{{$datas['system']['description']}}"/>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <!--引入公用样式-->
    <link rel="stylesheet" type="text/css" href="/home/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/home/css/public.css">
    <!--首页样式-->
    <link rel="stylesheet" type="text/css" href="/home/css/index.css">
    <link rel="stylesheet" type="text/css" href="/home/css/vaitalitySichuan.css">
    <!--视频样式-->
    <link rel="stylesheet" type="text/css" href="/home/css/newsContent.css">
    <link rel="stylesheet" type="text/css" href="/home/css/video.css">
    <link rel="stylesheet" type="text/css" href="/home/css/physicians.css">
    <script src="/home/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
        function sub(){
            var keywords = $('input[name=keywords]').val();
            if(keywords == null || keywords == undefined || keywords == ''){
                layer.msg('请输入查询关键词');
            }else{
                $('#frm').submit();
            }
        }
    </script>
</head>
<body>
<!--顶部-->
<div class="header comWidth clearfix">
    <div class="header-left clearfix">
        <div class="logo">@if(!empty($datas['system']->img))<img src="{{$datas['system']->img}}"> @else <img src="/home/img/logo.png"> @endif</div>
        <div class="link"> <a href="@if(!empty($datas['system'])) {{$datas['system']->weibourl}} @endif" target="_blank">官方微博</a> <a href="@if(!empty($datas['system'])) {{$datas['system']->weixinurl}} @endif" target="_blank">官方微信</a> </div>
    </div>
    <div class="header-right">
        <form action="{{route('common.seachs')}}" method="post" id="frm">
        <div class="search clearfix">
                <input type="text" name="keywords" placeholder="请输入关键词">
                <a href="javascript:sub();">搜索</a>
        </div>
        </form>
    </div>
</div>

<!--导航-->
<div class="nav">
    <ul class="comWidth clearfix">
        <li><a @if($controller == 'IndexController') class="active" @endif href="/">首页</a></li>
        <li><a href="{{route('vitality.index')}}" @if($controller == 'VitalityController') class="active" @endif>活力四川</a></li>
        <li><a href="{{url('originalvideo/index')}}" @if($controller == 'OriginalVideoController') class="active" @endif>原创视频</a></li>
        <li><a href="{{route('doctor.index')}}" @if($controller == 'DoctorController') class="active" @endif>大医精诚</a></li>
        {{--<li><a href="{{route('healthy.index')}}"  @if($controller == 'HealthyController') class="active" @endif>健康教育</a></li>--}}
        <li><a href="{{route('welfare.index')}}"  @if($controller == 'WelfareController') class="active" @endif">健康公益</a></li>
        {{--<li><a href="{{route('authority.index')}}"  @if($controller == 'AuthorityController') class="active" @endif>权威发布</a></li>--}}
        <li><a href="{{route('about.index')}}"  @if($controller == 'AboutController') class="active" @endif>关于我们</a></li>
    </ul>
</div>

<!--广告位-->

<div class="comWidth advertising"><a href="{{adv(1)['url']}}"><img src="{{adv(1)['thumb']}}" alt="{{adv(1)['title']}}" style="max-height: 100px;"/></a></div>

<!--内容区域-->
@yield('contents')
<!--底部-->
<div class="footer">
    <div class="comWidth">
        <p class="subtitle">友情链接</p>
        <ul class="blogroll clearfix">
            @if(!empty($datas['links']))
                @foreach($datas['links'] as $vo)
                    <li><a href="{{$vo->url}}" target="_blank">{{$vo->title}}</a></li>
                @endforeach
            @endif
        </ul>
        <p class="subtitle">合作机构</p>
        <div class="cooperation">
        @if(!empty($datas['agency']))
            @foreach($datas['agency'] as $vo)
                <span><a href="{{$vo->url}}" target="_blank">{{$vo->title}}</a></span>
            @endforeach
        @endif
        </div>
        <p class="subtitle">关注我们</p>
        <div class="Qrcode clearfix">
            <div class="code weixin"> @if(!empty($datas['system']->weixin))<img src="{{$datas['system']->weixin}}"/>@endif
                <p>官方微信</p>
            </div>
            <div class="code"> @if(!empty($datas['system']->weibo))<img id="change" src="{{$datas['system']->weibo}}"/>@endif
                <p>官方微博</p>
            </div>
        </div>
    </div>
</div>
</body>
<!--引入js-->
<script src="/home/js/jquery.slideBox.min.js"></script>
<script src="/layer/layer.js"></script>
<script>
    jQuery(function($){
        $('#slider').slideBox({
            duration : 0.3,//滚动持续时间，单位：秒
            easing : 'linear',//swing,linear//滚动特效
            delay : 5,//滚动延迟时间，单位：秒
            hideClickBar : false,//不自动隐藏点选按键
            clickBarRadius : 10
        });
    });
</script>
<div style="display: none;">
    {{$datas['system']['tongji']}}
</div>
<div id="goTopBtn"></div>
<script type="text/javascript">
    $(window).scroll(function(){
        var sc=$(window).scrollTop();
        var rwidth=$(window).width()
        if(sc>0){
            $("#goTopBtn").css("display","block");
            $("#goTopBtn").css("left","90%")
        }else{
            $("#goTopBtn").css("display","none");
        }
    })
    $("#goTopBtn").click(function(){
        var sc=$(window).scrollTop();
        $('body,html').animate({scrollTop:0},500);
    })
</script>
</html>