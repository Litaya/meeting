@extends('layouts.app')
@section('content')
    <div class="container" style="padding-top: 30px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">部门信息</div>
                    <div class="panel-body" style="color:#555">
                        @if(isset($user->department_id))
                            <h5>我的部门：{{ $user->department->name }}</h5>
                        <h5>部门负责人：{{ $user->department->manager->name }}</h5>
                            <h5>同部门成员：</h5>
                            <ul>
                                @foreach($codept_users as $codept_user)
                                    <li> {{ $codept_user->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop