@extends('layouts.app')
@section('content')
    <div class="container" style="padding-top: 30px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                预订会议室 &nbsp;&nbsp;&nbsp;&nbsp; <a href="{{ route('reserve.record') }}"> <small>查看我的预约记录</small></a>
            </div>
            <div class="panel-body">
                <div class="col-xs-12">
                    <form action="{{ route('reserve.store') }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="subject">会议主题</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="主题">
                        </div>
                        <div class="form-group">
                            <label for="number">会议人数</label>
                            <input type="number" class="form-control" name="number" id="number" placeholder="会议人数">
                        </div>
                        <div class="form-group">
                            <label for="address">会议地点</label>
                            <select type="" class="form-control" name="address" id="address">
                                <option value="0">选择地点</option>
                                <option value="1">401</option>
                                <option value="2">402</option>
                                <option value="3">403</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_datetime">起始时间</label>
                            <input type="text" class="form-control" name="start_datetime" value="2017-04-01 14:45" readonly id="start_datetime">
                        </div>
                        <div class="form-group">
                            <label for="end_datetime">结束时间</label>
                            <input type="text" class="form-control" name="end_datetime" value="2017-04-01 14:45" readonly id="end_datetime">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="立即预约">
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
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop