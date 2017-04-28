@extends('admin.layouts.frame')

@section('title','部门管理')

@section('body')
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
        <h4>部门负责人：{{ isset($department->manager)?$department->manager->name:"未设置" }}
            <small><a href="javascript:void(0)" data-toggle="modal" data-target="#alterDepartmentManager"><i class="fa fa-edit"></i></a></small>
        </h4>
    </div>
    <div class="row">
        <h4>部门成员 <small><a href="javascript:void(0)" data-toggle="modal" data-target="#alterDepartmentMember"><i class="fa fa-edit"></i></a></small></h4>
        <div class="col-lg-4">
            <ul class="list-group">
            @foreach($members as $member)
                <li class="list-group-item">
                    <small style="font-size: 12px;">
                        <a href="{{ route('admin.department.remove_member',['id'=>$department->id,'user_id'=>$member->id]) }}" style="color: red"><i class="fa fa-times"></i></a>
                    </small>
                    {{$member->name}}
                </li>
            @endforeach
            </ul>
        </div>
    </div>

    <div class="modal fade " id="alterDepartmentManager" tabindex="-1" role="dialog" aria-labelledby="alterDepartmentManagerLabel" style="margin-top: 100px;">
        <div class="modal-dialog modal-sm" role="document" style="position: static;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="alterDepartmentManagerLabel">修改部门负责人</h4>
                </div>
                <form class="form form-inline" action="{{ route('admin.department.set_manager') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body" style="padding:10px 40px;">
                        <div class="form-group">
                            <input type="text" name="department_id" value="{{ $department->id }}" hidden>
                            <label for="manager">修改为</label>
                            <div class="dowebok">
                                <select id="user_id" name="user_id" class="form-control" style="max-width:600px;">
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
                        <button type="submit" class="btn btn-success">确认修改</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade  bs-example-modal-sm" id="alterDepartmentMember" tabindex="-1" role="dialog" aria-labelledby="alterDepartmentMemberLabel" style="margin-top: 100px;">
        <div class="modal-dialog modal-sm" role="document" style="position: static;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="alterDepartmentMemberLabel">管理部门成员</h4>
                </div>
                <form class="form form-inline" action="{{ route('admin.department.alter_members') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body" style="padding:10px 40px;">
                        <div class="form-group">
                            <input type="text" name="department_id" value="{{ $department->id }}" hidden>
                            <label for="manager">修改为</label>
                            <div class="dowebok">
                                <select id="user_id" name="user_ids[]" class="form-control" multiple style="max-width:600px;">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->department_id == $department->id?"selected":"" }}>{{ $user->name }}
                                            ({{ isset($user->department)?$user->department->name:"暂未分配" }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
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

@stop