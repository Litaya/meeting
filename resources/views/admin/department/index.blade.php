@extends('admin.layouts.frame')

@section('title','部门管理')

@section('body')
    <style>
        a{
            text-decoration: none;
            color:#444;
        }
        a:hover, a:focus{
            text-decoration: none;
            color:#444;
        }
        .department-item{
            box-shadow: 1px 1px 5px #ccc;
        }
        .department-item:hover{
            box-shadow: inset 1px 1px 5px #ccc;
        }
    </style>

    <div class="row">
        <h3><i class="fa fa-university push"></i>部门管理 &nbsp;&nbsp;
            <small><button class="btn btn-success btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#createDepartment"><i class="fa fa-plus push"></i>添加部门</button></small>
        </h3>
        <hr>
    </div>
    <div class="row">
        @foreach($departments as $department)
            <div class="col-lg-3">
                <a href="{{ route('admin.department.show',['id'=>$department->id]) }}">
                    <div class="panel panel-default department-item">
                        <div class="panel-body" style="text-align: center">
                            <h4>{{ $department->name }}</h4>
                            <p>部门主管：{{ isset($department->manager)?$department->manager->name:"未设置" }}</p>
                            {{--<p>部门成员：12个&nbsp;&nbsp;主管：xxx</p>--}}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Modal -->
            <div class="modal fade" id="createDepartment" tabindex="-1" role="dialog" aria-labelledby="createDepartmentLabel" style="margin-top: 100px;">
                <div class="modal-dialog" role="document" style="position: static;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="createDepartmentLabel">添加部门</h4>
                        </div>
                        <form class="form form-horizontal" action="{{ route('admin.department.create') }}" method="post">
                            {{ csrf_field() }}
                            <div class="modal-body" style="padding:10px 40px;">
                                <div class="form-group">
                                    <label for="name">部门名称</label>
                                    <input id="name" name="name" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="manager">部门负责人</label>
                                    <div class="dowebok">
                                        <select id="manager" name="manager" class="form-control" style="max-width:600px;">
                                            <option value="0">请选择</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                <button type="submit" class="btn btn-success">确认添加</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop