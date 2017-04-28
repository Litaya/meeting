@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="/css/combo.select.css">
    <script src="/js/jquery.combo.select.js"></script>
    <style>
        #sider{
            background-color: #333333;
            color:#fff;
            min-height: 700px;
        }
        #main-body{
            padding-top: 40px;
            padding-right: 100px;
        }
        .container{
            margin:0;
            padding:0;
            width: 100%;
        }
    </style>
    <div class="container" style="max-width: 1300px;">
        <div class="col-lg-2" style="padding-left: 0;padding-right: 40px;">
            <div id="sider" class="col-lg-12" style="padding-left: 0;">
                @include('admin.layouts._sider')
            </div>
        </div>
        <div id="main-body" class="col-lg-10">
            @include('admin.layouts._message')
            @yield('body')
        </div>
    </div>


    <script>
        $(function() {
            $('select').comboSelect();
        });
    </script>
@stop