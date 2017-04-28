<style>
    .header-item{
        text-align:center;
        color:#99CCFF;
        background-color: white;
        box-shadow: 1px 1px 5px #ccc;
        border-radius: 10px;
        padding:10px 20px;
    }
    .header-item.active{
        box-shadow: inset 0px 0px 5px #ccc;
        background-color: #fcfcfc;
    }
</style>
<div class="row">
    <a href="{{ route('admin.meeting-room.index') }}">
        <div class="col-lg-1 col-lg-offset-3 header-item @yield('meeting-room-active')">
            <img src="/img/room.png" alt="meeting-room" width="100%">
            会议室
        </div>
    </a>

    <a href="{{ route('admin.user.index') }}">
        <div class="col-lg-1 col-lg-offset-1 header-item @yield('user-active')">
            <img src="/img/user.png" alt="user" width="100%">
            用户
        </div>
    </a>

    <a href="{{ route('admin.meeting.index') }}">
        <div class="col-lg-1 col-lg-offset-1 header-item @yield('meeting-active')">
            <img src="/img/meeting.png" alt="meeting" width="100%">
            会议
        </div>
    </a>
</div>
