<?php

namespace App;


use Illuminate\Http\Request;

class PermissionModel
{

	public static $permissions = [
		0 => [
			'reserve.index', 'reserve.show', 'reserve.apply',
			'department.index',
			'project.index', 'project.show',
			'user'
		],
		1 => [
			'admin'
		],
		2 => [
			'admin.index',
			'admin.reserve',
			'admin.department',
			'admin.meeting-room',
			'admin.user'
		],
		3 => [ // 部门负责人
			'index',
			'reserve',
			'department.privilege',
			'project.index',
			'user'
		],
		4 => [
			'index',
			'reserve',
			'department.index',
			'project.privilege',
			'user'],
		5 => [
			'index',
			'reserve',
			'department.index',
			'project.index',
			'user.index'
		],
	];

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

	public static function hasPermission($type, $routeName){
		$user_permission = self::$permissions[$type];
		foreach ( $user_permission as $permission){
			if(strstr($routeName,$permission)){
				return true;
			}
		}
		return false;
	}

	public static function redirect($type){
		switch ($type){
			case 0:
			case 3:
			case 4:
		    	return redirect()->route('home');
		    	break;
			case 1:
			case 2:
				return redirect()->route('admin.index');
				break;
			default:
				return redirect()->route('home');
				break;
		}
	}
}
