<style>
    #sider-nav{
        padding:0;
    }
    #sider-nav>li{
        list-style: none;
    }
    #sider-nav>li>a{
        color: #555;
        text-decoration: none;
    }
    .push{
        margin-right: 5px;
    }
    .sider-nav-header{
        margin:30px 0;
    }
    .sider-nav-item{
        text-align: left;
        margin-top: 20px;
        margin-left: 20px;
    }
</style>

<div class="col-lg-12">
    <ul id="sider-nav">
        <li class="sider-nav-header"><a href="{{ route('admin.index') }}"><h4><i class="fa fa-th-large push"></i>全部模块</h4></a></li>
        <li class="sider-nav-item"><a href="{{ route('admin.privilege.index') }}"><i class="fa fa-key push"></i>权限管理</a></li>
        <li class="sider-nav-item"><a href="{{ route('admin.department.index') }}"><i class="fa fa-university push"></i>部门管理</a></li>
        <li class="sider-nav-item"><a href="{{ route('admin.project.index') }}"><i class="fa fa-calendar push"></i>项目管理</a></li>
        <li class="sider-nav-item"><a href="{{ route('admin.meeting-room.index') }}"><i class="fa fa-briefcase push"></i>会议室管理</a></li>
        <li class="sider-nav-item"><a href="{{ route('admin.meeting.index') }}"><i class="fa fa-check push"></i>预约管理</a></li>
    </ul>
</div>