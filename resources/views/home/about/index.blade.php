@extends('home.common.common')
@section('contents')
        <!--内容区域-->
<div class="comWidth">
    <div class="content clearfix">
        <div class="article">
            <div class="articleTitle">
                <span>关于我们</span>
                <i>ABOUT US</i>
            </div>
        </div>
        <div class="about">@if(!empty($info->about)){!! $info->about !!}@endif</div>
    </div>
    <div class="content clearfix">
        <div class="article">
            <div class="articleTitle">
                <span>联系我们</span>
                <i>CONTACT US</i>
            </div>
        </div>
        <div class="contact">@if(!empty($info->contact)){!! $info->contact !!}@endif</div>
    </div>
    <div class="content clearfix">
        <div class="article">
            <div class="articleTitle">
                <span>关注我们</span>
                <i>FOLLOW US</i>
            </div>
        </div>
        <div class="contact">@if(!empty($info->follow)){!! $info->follow !!}@endif</div>
    </div>
</div>
@endsection