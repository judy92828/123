<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ isset($title) ? $title : "后台管理系统" }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/admin/bootstrap/css/bootstrap.min.css">
        <!-- Theme style -->
    <link rel="stylesheet" href="/admin/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/admin/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/admin/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="/admin/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/admin/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- jQuery 2.2.0 -->
    <script src="/admin/plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/admin/build/jquery-ui.min.js"></script>
    <link href="/admin/css/inserthtml.com.radios.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/admin/plugins/iCheck/all.css">
    <style type="text/css">
        .common_link:hover{
            background-color: #3c8dbc!important;
        }
        .atv{background-color: #00a65a; color: #fff;}
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="{{url('admin/index')}}" class="logo">
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>后台管理系统</b></span> </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">                              
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a style="display:block-inline;float:left;;padding-right:0;" class="common_link">@if($user->type==0)管理员 @else 发布管理员 @endif ：{{ isset($user) ? $user->name : "admin" }}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        <a style="display:inline;cursor:pointer;float:right;padding-left:0" class="common_link" href="/login/quit">退出登录</a>
                        <a style="display:inline;cursor:pointer;float:right;padding-left:0" class="common_link" href="/" target="_blank">网站首页</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="image" style="text-align: center;"> <img src="/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> </div>
                <div style="text-align: center;color: #fff; padding-top: 10px;">
                    <p>当前管理员：{{ isset($user) ? $user->name : 'admin' }}</p>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">Welcome Administrators</li>
                @foreach($menus as $menu)
                        <li class="treeview @if($menu['controller'] == $controller) active @endif"> <a href="javascript:;"> <i class="fa fa-files-o"></i> <span>{{ $menu['name']}}</span></a>
                                <ul class="treeview-menu">
                                    @foreach($menu['menues'] as $m)
                                      @if($user->type==1)
                                          @if($m['name']=="待审核" || $m['name']=="待发布" || $m['name']=="已发布" || $m['name']=="发布管理" || $m['name']=="推荐视频" || $m['name']=="机构发布管理")
                                             @continue
                                           @endif
                                      @endif
                                      @if(empty($status))
                                        <li @if($m['action']==$action&&$menu['controller'] == $controller) class="atv" @endif><a href="{{$m['url']}}">{{$m['name']}}</a></li>
                                        @else
                                            <li @if($m['action']==$action&&$menu['controller'] == $controller&&$status==$m['state']) class="atv" @endif><a href="{{$m['url']}}">{{$m['name']}}</a></li>
                                         @endif
                                    @endforeach
                                </ul>
                @endforeach
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        @yield('contentes')
        <!-- /.content -->
    </div>
</div>
<style>
    .edui-default{line-height: 28px;}
    div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
    {overflow: hidden; height:20px;}
    div.edui-box{overflow: hidden; height:22px;}
    .file {
        position: relative;
        display: inline-block;
        background: #D0EEFF;
        border: 1px solid #99D3F5;
        border-radius: 4px;
        padding: 4px 12px;
        overflow: hidden;
        color: #1E88C7;
        text-decoration: none;
        text-indent: 0;
        line-height: 24px;
        vertical-align: middle;
        margin-left: 15px;;
    }
    .file input {
        position: absolute;
        font-size: 100px;
        right: 0;
        top: 0;
        opacity: 0;
    }
    .file:hover {
        background: #AADFFD;
        border-color: #78C3F3;
        color: #004974;
        text-decoration: none;
    }
</style>
<!-- ./wrapper -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 3.3.6 -->
<script src="/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="/admin/build/raphael-min.js"></script>
{{--<script src="/admin/plugins/morris/morris.min.js"></script>--}}
<!-- Sparkline -->
<script src="/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/admin/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="/admin/build/moment.min.js"></script>
<script src="/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/admin/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/admin/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="/admin/dist/js/pages/dashboard.js"></script>--}}
<!-- AdminLTE for demo purposes -->
<script src="/admin/dist/js/demo.js"></script>
<script src="/layer/layer.js"></script>
<script src="/admin/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
</script>
</body>
</html>
