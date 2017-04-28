@extends('admin.layouts.frame')

@section('title','管理员后台')

@section('body')
    <div class="row">
        <div class="col-lg-7">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 12px;">查询预订
                    &nbsp; <a href="javascript:void(0)">今日</a>
                    &nbsp; <a href="javascript:void(0)">昨日</a>
                    <form action="#" method="post" class="form-inline" style="display: inline">
                        &nbsp; 选择日期:<input style="width:130px; background-color: #f5f5f5;border:none;text-align: center; color:#99CCFF" type="text" value="2017-04-01 14:45" name="start_time" readonly id="start_datetime">-
                        <input style="width:130px; background-color: #f5f5f5;border:none;text-align: center; color:#99CCFF" type="text" name="end_time" value="2017-04-01 14:45" readonly id="end_datetime">
                        <input href="javascript:void(0)" class="btn btn-default btn-sm" value="查询" style="width:50px;">
                    </form>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>预约人</th>
                            <th>会议主题</th>
                            <th>参会人数</th>
                            <th>会议地点</th>
                            <th>开始时间</th>
                            <th>结束时间</th>
                        </tr>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->subject }}</td>
                                <td>{{ $reservation->number }}</td>
                                <td>{{ $reservation->meeting_room_id }}</td>
                                <td>{{ $reservation->start }}</td>
                                <td>{{ $reservation->end }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <script type="text/javascript">
                    $('#start_datetime').datetimepicker({
                        language:  'zh-CN',
                        format: 'yyyy-mm-dd hh:ii'
                    });
                    $('#end_datetime').datetimepicker({
                        language:  'zh-CN',
                        format: 'yyyy-mm-dd hh:ii'
                    });
                </script>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="panel panel-default">
                <div class="panel-heading">新用户</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>id</th>
                            <th>用户名</th>
                            <th>邮箱</th>
                            <th>注册时间</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop