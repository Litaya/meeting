@extends('layouts.app')
@section('content')
    <div class="container">
        <h4>我的预约记录</h4>
        <hr>
        @foreach( $reservations as $reservation)
            <div class="panel panel-{{ $reservation->status == -1?'danger':'success' }}">
                <div class="panel-heading">
                    {{ $reservation->subject }} {{ $reservation->status == -1?'已取消':'' }} &nbsp;
                    @if($reservation->status != -1)
                        <a href="{{ route('reserve.cancel',$reservation->id) }}">取消</a>
                    @endif
                </div>
                <div class="panel-body">
                    <p><strong>会议地点</strong>&nbsp;&nbsp;{{ $reservation->meeting_room_id }}</p>
                    <p><strong>会议人数</strong>&nbsp;&nbsp;{{ $reservation->number }}</p>
                    <p><strong>预约时间</strong>&nbsp;&nbsp;{{ date('Y-m-d H:i',strtotime($reservation->start)) }}&nbsp;&nbsp;到&nbsp;&nbsp;{{ date('Y-m-d H:i',strtotime($reservation->end)) }}</p>

                </div>
            </div>
        @endforeach

    </div>
@stop