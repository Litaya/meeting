<?php
namespace App\Helpers;

class UserTypeHelper{
	public static function getType($type){
		$type_name = '';
		switch ($type){
			case 0:
				$type_name = '普通用户';
				break;
			case 1:
				$type_name = '行政主管';
				break;
			case 2:
				$type_name = '行政助理';
				break;
			case 3:
				$type_name = '部门负责人';
				break;
			case 4:
				$type_name = '项目负责人';
				break;
			case 5:
				$type_name = '会议助理';
				break;
			default:
				break;
		}
		return $type_name;
	}
}