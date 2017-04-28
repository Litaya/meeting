@extends('admin.layouts.frame')
@section('title','管理员后台')

@section('user-active','active')

@section('body')
    <div class="row" style="margin-top: 20px;">
        <div class=" col-lg-offset-1 col-lg-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    用户列表
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        @foreach($users as $user)
                            <li class="list-group-item">{{ $user->name }}</li>
                        @endforeach
                    </ul>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@stop