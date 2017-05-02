@extends('admin.layouts.frame')

@section('title','部门管理')

@section('body')
    <link rel="stylesheet" href="/css/multi-select.css" media="screen" rel="stylesheet" type="text/css">

    <div class="row">
        <form action="{{ route('admin.department.drop',['id'=>$department->id]) }}">
            <h3>
                <i class="fa fa-university push"></i>{{ $department->name }}
                &nbsp;&nbsp;
                <button type="submit" class="btn btn-danger btn-sm">删除部门</button>
            </h3>
        </form>
        <hr>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>预约记录</h4></div>
                    <div class="panel-body">该部门暂无预约记录</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>部门详细信息</h4></div>
                <div class="panel-body">
                    <h5>部门负责人：{{ isset($department->manager)?$department->manager->name:"未设置" }}
                        <small><a href="javascript:void(0)" data-toggle="modal" data-target="#alterDepartmentManager"><i class="fa fa-edit"></i></a></small>
                    </h5>

                    <h5>部门成员 <small><a href="javascript:void(0)" data-toggle="modal" data-target="#addDepartmentMembers"><i class="fa fa-plus"></i></a></small></h5>
                    <div class="col-lg-12">
                        <ol class="list-group">
                            @foreach($members as $member)
                                <li class="" style="margin-left: 20px;">
                                    <small style="font-size: 12px;">
                                        <a href="{{ route('admin.department.remove_member',['id'=>$department->id,'user_id'=>$member->id]) }}" style="color: red"><i class="fa fa-times"></i></a>
                                    </small>
                                    {{$member->name}}
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="alterDepartmentManager" tabindex="-1" role="dialog" aria-labelledby="alterDepartmentManagerLabel" style="margin-top: 100px;">
        <div class="modal-dialog modal-sm" role="document" style="position: static;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="alterDepartmentManagerLabel">修改部门负责人</h4>
                </div>
                <form class="form form-inline" action="{{ route('admin.privilege.dept.setmanager') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body" style="padding:10px 40px;">
                        <div class="form-group">
                            <input type="text" name="department_id" value="{{ $department->id }}" hidden>
                            <label for="manager">修改为</label>
                            <select id="user_id" name="user_id" class="form-control" style="max-width:600px;">
                                <option value="0">请选择</option>
                                @foreach($members as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-success">确认修改</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addDepartmentMembers" tabindex="-1" role="dialog" aria-labelledby="addDepartmentMembersLabel" style="margin-top: 100px;">
        <div class="modal-dialog modal-sm" role="document" style="position: static;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addDepartmentMembersLabel">添加成员到{{$department->name}}</h4>
                </div>
                <form class="form form-horizontal" action="{{ route('admin.department.add_members',['id'=>$department->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body" style="padding:10px 40px;">
                        <div class="form-group">
                            <input type="text" name="department_id" value="{{ $department->id }}" hidden>
                        </div>
                        <div class="form-group">
                            <label for="user_ids" >选择用户</label>
                            @if(sizeof($users)>0)
                                <select id="user_ids" name="user_ids[]" multiple="multiple" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->department_id == $department->id?"selected":"" }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <script src="/js/multiselect.min.js" type="text/javascript"></script>
                                <script>
                                    $("#user_ids").multiselect({});
                                </script>
                            @else
                                暂无未分配部门的用户
                            @endif

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
@stop