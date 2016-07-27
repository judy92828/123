@extends('admin.common.common')
@section('contentes')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">添加广告位</h3>
                        @if(count($errors)>0)
                            <div style="font-size: 16px;color: red;font-weight: bold;">
                                <!--判断$errors是对象还是只是一个数组-->
                                @if(is_object($errors))
                                    @foreach($errors->all() as $error)
                                        <p> {{$error}}</p>
                                    @endforeach
                                @else
                                    <p> {{$errors}}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{url('admin/adposition/'.$ap->id)}}" id="frm" class="form-horizontal" method="post">
                        <input type="hidden" name="_method" value="put">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">广告位名称</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" style="width: 300px;" name="name" value="{{$ap->name}}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">广告位置</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" style="width: 300px;" value="{{$ap->position}}" name="position" >
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="submit" id="btn" class="btn btn-info pull-right" value="确定修改">
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