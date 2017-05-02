@extends('admin.layouts.frame')

@section('title','管理员后台')

@section('body')
    <style>
        .top-module{
            border-radius: 80px;
            width: 160px;
            height:160px;
            margin:0 10px;
            text-align: center;
        }
        .top-module-text{
            margin-top:65px;
            font-size: 20px;
            color: #ffffff;
        }

        .privilege{
            background-color: #FFCC66;
        }
        .department{
            background-color: #66CC99;
        }
        .project{
            background-color: #FF9966;
        }
        .meeting-room{
            background-color: #CC99FF;
        }
        .meeting{
            background-color: #66CCFF;
        }
    </style>
    <div class="row">
        <a href="{{ route('admin.privilege.index') }}"><div class="col-lg-2 top-module privilege"><p class="top-module-text">权限管理</p></div></a>
        <a href="{{ route('admin.department.index') }}"><div class="col-lg-2 top-module department"><p class="top-module-text">部门管理</p></div></a>
        <a href="{{ route('admin.project.index') }}"><div class="col-lg-2 top-module project"><p class="top-module-text">项目管理</p></div></a>
        <a href="{{ route('admin.meeting-room.index') }}"><div class="col-lg-2 top-module meeting-room"><p class="top-module-text">会议室管理</p></div></a>
        <a href="{{ route('admin.meeting.index') }}"><div class="col-lg-2 top-module meeting"><p class="top-module-text">会议管理</p></div></a>
    </div>
    <div class="row" style="margin-top: 20px;">
        <hr>
        <div class="col-lg-6">
            <div id="main" style="width: 100%;height:400px;"></div>
        </div>
        <div class="col-lg-6">
            <div id="chart-department" style="width: 100%;height:400px;"></div>
        </div>
        <script>
                var myChart = echarts.init(document.getElementById('main'));

                // 指定图表的配置项和数据
                var option = {
                    title: {
                        text: '用户注册趋势'
                    },
                    tooltip: {},
                    legend: {
                        data:['注册量']
                    },
                    xAxis: {
                        data: ["04-17","04-18","04-19","04-20","04-21","04-22","04-23","04-24","04-25"]
                    },
                    yAxis: {},
                    series: [{
                        name: '注册量',
                        type: 'line',
                        data: [1, 1, 2, 2, 2, 1,0,1,1]
                    }]
                };

                // 使用刚指定的配置项和数据显示图表。
                myChart.setOption(option);

                var departmentReserve = echarts.init(document.getElementById('chart-department'));
                departmentReserve.setOption({
                    title:{
                        text:'各部门会议数量'
                    },
                    tooltip: {},
                    series : [
                        {
                            name: '月开会次数',
                            type: 'pie',
                            radius: '55%',
                            data:[
                                {value:2, name:'行政部'},
                                {value:1, name:'测试部'},
                                {value:1, name:'研发部'},
                                {value:4, name:'销售部'},
                                {value:3, name:'市场部'}
                            ]
                        }
                    ]
                })
            </script>
    </div>
@stop