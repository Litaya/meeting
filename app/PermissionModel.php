<?php

namespace App;


class PermissionModel
{
    public static function getIdentityByType($type){
    	switch ($type){
		    case 0:
			    return '普通用户';
			    break;
		    case 1:
			    return '行政主管';
			    break;
		    case 2:
			    return '行政助理';
			    break;
		    case 3:
			    return '部门负责人';
			    break;
		    case 4:
			    return '项目负责人';
			    break;
		    case 5:
			    return '会议助理';
			    break;
		    default:
		    	return '未知';
		    	break;
	    }
    }

    public static function hasPermission($type, $uri){
    	$permission_arr = [
    		0 => ['reserve','department','project','user'],
		    1 => ['admin.reserve','admin.department','admin.meeting-room','admin.user','admin.privilege'],
		    2 => ['admin.reserve','admin.department','admin.meeting-room','admin.user'],
		    3 => ['reserve','department','project','user'],
		    4 => ['reserve','department','project','user'],
		    5 => ['reserve','department','project','user'],
	    ];
    }
}
