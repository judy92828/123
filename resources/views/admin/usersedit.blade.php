@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">管理员修改</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{url('admin/userslist/'.$data->id)}}" class="form-horizontal" method="post">
                        <input type="hidden" name="_method" value="put">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">管理员登录帐号</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="{{$data->name}}" placeholder="请输入管理员帐号" disabled>
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
                                    <input type="text" class="form-control" value="{{$data->email}}" name="email" placeholder="请输入邮箱地址">
                                </div>
                            </div>
                            @if($data->id !=1)
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">管理员类别</label>
                                <div class="col-sm-10" style="margin-top:6px;">
                                    <input type="radio"  value="0" @if($data->type==0) checked @endif name="type">总管理员
                                    <input type="radio"  value="1" @if($data->type==1) checked @endif name="type">发布管理员
                                </div>
                            </div>
                            @endif
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">确定修改</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection