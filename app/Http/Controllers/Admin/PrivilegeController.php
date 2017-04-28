<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PrivilegeController extends Controller
{
	public function index(Request $request){
		$user = Auth::user();
		if($user->type == 1){
			$users = User::paginate(10);
			$personnel_managers   = User::where('type',1)->paginate(10);
			$personnel_assistants = User::where('type',2)->paginate(10);
			$department_managers = User::where('type',3)->paginate(10);
			$project_managers    = User::where('type',4)->paginate(10);
			return view('admin.privilege.personnel_manager_index',compact('users','personnel_managers','personnel_assistants','department_managers','project_managers'));
		}else{
			$request->session()->flash('notice_msg','您无权访问此模块');
			$request->session()->flash('notice_status','danger');
			return view('admin.privilege.index');
		}
	}

	public function setUserType(Request $request){
		$this->validate($request,[
			'user_id' => 'required',
			'type' => 'required'
		]);

		$user_id   = $request->get('user_id');
		$user_type = $request->get('type');

		$admin = Auth::user();
		$user  = User::where('id',$user_id)->first();
		if(in_array($user_type,[2,3,4]) && $admin->type == 1 && $admin->id != $user_id){
			if($user->type !==0){
				$request->session()->flash('notice_msg','用户已有身份！');
				$request->session()->flash('notice_status','danger');
				return 'failed';
			}
			User::where('id',$user_id)->update(['type'=>$user_type]);
			return 'success';
		}
		$request->session()->flash('notice_msg','您无权进行此操作！');
		$request->session()->flash('notice_status','danger');
		return 'failed';
	}

	public function depriveUserPrivilege(Request $request){
		$this->validate($request,[
			'user_id' => 'required'
		]);
		$user_id = $request->get('user_id');
		$user    = User::where('id',$user_id)->first();
		$admin   = Auth::user();
		Log::info($user);
		if(!empty($user) && in_array($user->type,[2,3,4]) && $admin->type == 1 && $admin->id != $user_id){
			User::where('id',$user_id)->update(['type'=>0]);
			if($user->type == 3){
				Department::where('id',$user->department_id)->update(['manager_id'=>0]);
			}
			if($user->type == 4){
				Project::where('id',$user->project_id)->update(['manger_id'=>0]);
			}
			return 'success';
		}
		$request->session()->flash('notice_msg','您无权进行此操作！');
		$request->session()->flash('notice_status','danger');
		return 'failed';
	}
}
