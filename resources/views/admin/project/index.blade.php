@extends('admin.layouts.frame')

@section('title','项目管理')

@section('body')
    <style>
        a:hover{
            text-decoration: none;
        }
    </style>

    <div class="row">
        <h3><i class="fa fa-calendar push"></i>项目管理</h3>
        <hr>
    </div>

    <div class="row">
        <h4>已审核项目</h4>
        <div class="col-lg-6" style="padding:0">
            <div class="panel panel-default" style="margin-bottom: 5px;">
                <div class="panel-body">
                    <p><a href="javascript:void(0)">代码质量检查组</a>&nbsp;&nbsp;<a href="javascript:void(0)" style="color:red" onclick="dropProject(1)"><i class="fa fa-times"></i>删除</a></p>
                    <p>
                        <strong>创建人：</strong>李晨<br>
                        <strong>负责人：</strong>李晨 <i class="fa fa-edit"></i><br>
                        <strong>成员：</strong>李小可、李佳蔓、罗仪、王志程、张星尧
                    </p>
                    <p>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <hr>
        <h4>待审核项目</h4>
        <div class="col-lg-6" style="padding:0">
            <div class="panel panel-default" style="margin-bottom: 5px;">
                <div class="panel-body">
                    <p><a href="javascript:void(0)">代码质量检查组</a>
                        &nbsp;&nbsp;<a href="javascript:void(0)" style="color:green" onclick="acceptProject(1)"><i class="fa fa-check"></i>同意</a>
                        &nbsp;&nbsp;<a href="javascript:void(0)" style="color:red" onclick="dropProject(1)"><i class="fa fa-times"></i>删除</a>
                    </p>
                    <p>
                        <strong>创建人：</strong>李晨<br>
                        <strong>负责人：</strong>李晨 <i class="fa fa-edit"></i><br>
                        <strong>成员：</strong>李小可、李佳蔓、罗仪、王志程、张星尧
                    </p>
                    <p>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function dropProject(project_id) {
            alert("确定删除吗？");
        }
    </script>
@stop