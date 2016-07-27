@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">添加管理员</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{url('admin/userslist')}}" id="frm" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">管理员登录帐号</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" value="" placeholder="请输入管理员帐号">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">管理员登录密码</label>

                                <div class="col-sm-10">
                                    <input type="password" class="form-control" value="" name="password" placeholder="请输入管理员密码">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">邮箱地址</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="" name="email" placeholder="请输入邮箱地址">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">管理员类别</label>

                                <div class="col-sm-10" style="margin-top:6px;">
                                    <input type="radio"  value="0" checked name="type">总管理员
                                    <input type="radio"  value="1" name="type">发布管理员
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" id="btn" class="btn btn-info pull-right">确定添加</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <script type="text/javascript">
        $(function(){
            $('#btn').click(function(){
                var username=$('input[name=username]').val();
                var password=$('input[name=password]').val();
                if (username == null || username == undefined || username == '') {
                   layer.msg('请输入登录用户名');return false;
                }
                if (password == null || password == undefined || password == '') {
                    layer.msg('请输入登录密码');return false;
                }else{
                    $('#frm').submit();
                }
            })
        })
    </script>
@endsection