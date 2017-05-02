@extends('layouts.app')
@section('content')
    <style>
        #sider{
            background-color: #f8f8f8;
            color:#fff;
            min-height: 750px;
        }
        #main-body{
            padding-top: 40px;
            padding-right: 100px;
        }
    </style>
    <script src="/js/echarts.min.js"></script>
    <div class="container" style="max-width: 1300px;padding:0;margin:0;">
        <div class="col-lg-2" style="padding-left: 0;padding-right: 40px;">
            <div id="sider" class="col-lg-12" style="padding-left: 0; box-shadow: 1px 3px 5px #ccc;">
                @include('admin.layouts._sider')
            </div>
        </div>
        <div id="main-body" class="col-lg-10" style="padding:40px 0 30px 0">
            @include('admin.layouts._message')
            @yield('body')
        </div>
    </div>

@stop