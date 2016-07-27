@extends('admin.common.common')
@section('contentes')
    <div class="content-wrapper" style="margin-left: 0px;">
        <br/>
        {{--<div class="pad margin no-print">--}}
            {{--<div class="callout callout-info" style="margin-bottom: 0!important;">--}}
                {{--<h4><i class="fa fa-info"></i> Note:</h4>--}}
                {{--This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.--}}
            {{--</div>--}}
        {{--</div>--}}

        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i>环境配置
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col"><address><strong>操作系统：{{PHP_OS}}</strong></address></div>
                <div class="col-sm-4 invoice-col"><address><strong>上传附件限制: <?php echo get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传附件"; ?></strong></address></div>
                <div class="col-sm-4 invoice-col"><address><strong>北京时间:<?php echo date('Y年m月d日 H时i分s秒')?></strong></address></div>
                <div class="col-sm-4 invoice-col"><address><strong>服务器域名/IP:{{$_SERVER['SERVER_NAME']}}</strong></address></div>
                <div class=" invoice-col"><address><strong style="margin-left: 15px;">运行环境:{{$_SERVER['SERVER_SOFTWARE']}}</strong></address></div>
            </div>
            <!-- /.row -->
            <br/>
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i>最新文章
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th width="*">文章标题</th>
                            <th width="100">阅读量</th>
                            <th width="200">当前状态</th>
                            <th width="200">发布时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($article as $vo)
                        <tr>
                            <td>{{$vo->title}}</td>
                            <td>{{$vo->views}}</td>
                            <td>@if($vo->status==0) 待审核 @elseif($vo->status==1) 待发布 @else 已发布 @endif</td>
                            <td>{{$vo->created_at}}</td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <br/>
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i>数据统计
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">文章：</th>
                                <td>@if(is_null($arnum)) 0 @else {{$arnum}} @endif 条信息</td>
                            </tr>
                            <tr>
                                <th>视频：</th>
                                <td>@if(is_null($vinum)) 0 @else {{$vinum}} @endif 条信息</td>
                            </tr>
                            <tr>
                                <th>合作机构：</th>
                                <td>@if(is_null($agnum)) 0 @else {{$agnum}} @endif 条信息</td>
                            </tr>
                            <tr>
                                <th>地方频道：</th>
                                <td>@if(is_null($linum)) 0 @else {{$linum}} @endif 条信息</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
@endsection