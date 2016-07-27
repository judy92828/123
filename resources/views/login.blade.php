<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>后台登录管理</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="{{asset('/admin/js/jquery-1.9.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin/images/login.js')}}"></script>
    <link href="{{asset('/admin/css/login2.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>后台登录管理<sup>2016</sup></h1>
<div class="login" style="margin-top:50px;">
    <div class="web_qr_login" id="web_qr_login" style="display: block; margin-bottom:20px;">
        @if(count($errors)>0)
        @if(is_object($errors))
        @foreach($errors->all() as $v)
                <div style="text-align: center;color: #f00;">{{$v}}</div>
                @endforeach
        @else
                <div style="text-align: center;color: #f00;">{{$errors}}</div>
            @endif
        @endif
    <!--登录-->
        <div class="web_login" id="web_login">
            <div class="login-box">
                <div class="login_form">
                    <form action="" name="loginform" accept-charset="utf-8" id="login_form" class="loginForm" method="post">
                        {{csrf_field()}}
                        <div class="uinArea" id="uinArea">
                            <label class="input-tips" for="u">帐号：</label>
                            <div class="inputOuter" id="uArea">
                                <input type="text" name="username" class="inputstyle"  placeholder="请输入登录帐号" autofocus/>
                            </div>
                        </div>
                        <div class="pwdArea" id="pwdArea">
                            <label class="input-tips" for="p">密码：</label>
                            <div class="inputOuter" id="pArea">
                                <input type="password" name="password" class="inputstyle" placeholder="请输入登录密码"/>
                            </div>
                        </div>
                        <div class="pwdArea" id="pwdArea">
                            <label class="input-tips" for="p">验证码：</label>
                            <div class="inputOuter" id="pArea">
                                <input type="text" name="code" class="inputstyle" placeholder="请输入验证码" style="width: 100px; float: left;"><img src="{{url('/login/code')}}" style="vertical-align: middle;"  onclick="this.src='{{url('/login/code')}}?'+Math.random()"/>
                            </div>
                        </div>

                        <div style="padding-left:50px;margin-top:20px;">
                            <input type="submit" value="登 录" style="width:150px;" class="button_blue"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--登录end-->
    </div>
</div>
<div class="jianyi">*推荐使用ie8或以上版本ie浏览器或Chrome内核浏览器访问本站</div>
</body>
</html>