@extends('admin.layouts.frame')

@section('title','权限管理')

@section('body')
    <style>
        .panel-body{
            padding:0;
        }
    </style>
    <div class="row">
        <h3><i class="fa fa-key push"></i>权限管理</h3>
        <hr>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    所有用户
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>id</td>
                            <td>用户名</td>
                            <td>邮箱</td>
                            <td>身份</td>
                            <td>设置为</td>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ \App\Helpers\UserTypeHelper::getType($user->type) }}</td>
                                <td>
                                    <a href="javascript:void(0)" onclick="setUserType({{ $user->id }}, 2)">助理</a>
                                    {{--<a href="{{ route('admin.department.index') }}">部门</a>--}}
                                    {{--<a href="{{ route('admin.project.index') }}">项目</a>--}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="col-lg-12" style="text-align: center">{{ $users->links() }}</div>
                </div>
            </div>
        </div>
        <script>
            function setUserType(user_id, user_type, target_id){
                var data = {};
                if(user_type == 2){
                    data = {
                        user_id: user_id,
                        type: user_type
                    }
                }else if(user_type == 3){
                    if(target_id == null){
                        alert('非法操作！');
                        return;
                    }
                    data = {
                        user_id: user_id,
                        type: user_type,
                        department_id: target_id
                    }
                }else if(user_type == 4){
                    if(target_id == null){
                        alert('非法操作！');
                        return;
                    }
                    data = {
                        user_id: user_id,
                        type: user_type,
                        project_id: target_id
                    }
                }else{
                    alert('非法操作！');
                    return;
                }
                $.ajax({
                    type: 'get',
                    url: '{{ route('admin.privilege.setposition') }}',
                    data: data,
                    success: function (result) {
                        if(result == 'success')
                            location.reload();
                        else{
                            location.reload();
                        }
                    },
                    error:function (result) {
                        alert('操作失败！');

                    }
                });
            }

            function depriveUserPrivilege(user_id) {
                var data = {
                    user_id: user_id
                };
                $.ajax({
                    type: 'get',
                    url: '{{ route('admin.privilege.dropposition') }}',
                    data: data,
                    success: function (result) {
                        if(result == 'success')
                            location.reload();
                        else
                            alert('操作失败！');
                    },
                    error:function (result) {
                        alert('操作失败！');
                    }
                });
            }
        </script>
        <div class="col-lg-5">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        行政助理
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>id</td>
                                <td>用户名</td>
                                <td>邮箱</td>
                                <td>操作</td>
                            </tr>
                            @foreach($personnel_assistants as $personnel_assistant)
                                <tr>
                                    <td>{{ $personnel_assistant->id }}</td>
                                    <td>{{ $personnel_assistant->name }}</td>
                                    <td>{{ $personnel_assistant->email }}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="depriveUserPrivilege({{ $personnel_assistant->id }})">删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="col-lg-12" style="text-align: center">{{ $personnel_assistants->links() }}</div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        部门负责人
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>id</td>
                                <td>用户名</td>
                                <td>部门</td>
                                <td>操作</td>
                            </tr>
                            @foreach($department_managers as $department_manager)
                                <tr>
                                    <td>{{ $department_manager->id }}</td>
                                    <td>{{ $department_manager->name }}</td>
                                    <td>{{ $department_manager->department->name }}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="depriveUserPrivilege({{ $department_manager->id }})">删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="col-lg-12" style="text-align: center">{{ $department_managers->links() }}</div>
                    </div>
                </div>`
                <div class="panel panel-default">
                    <div class="panel-heading">
                        项目负责人
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>id</td>
                                <td>用户名</td>
                                <td>邮箱</td>
                                <td>操作</td>
                            </tr>
                            @foreach($project_managers as $project_manager)
                                <tr>
                                    <td>{{ $project_manager->id }}</td>
                                    <td>{{ $project_manager->name }}</td>
                                    <td>{{ $project_manager->email }}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="depriveUserPrivilege({{ $project_manager->id }})">删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="col-lg-12" style="text-align: center">{{ $project_managers->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
