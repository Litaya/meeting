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
			$users = User::paginate(20);
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

	# ========= department part ========== #

	// web, post
	public function setDepartmentManager(Request $request){

		$this->validate($request,[
			'department_id' => 'required',
			'user_id'       => 'required'
		]);

		$department_id = $request->get('department_id');
		$user_id       = $request->get('user_id');

		$department  = Department::where('id',$department_id)->first();

		// 部门原本的管理员的身份设置为普通职员
		if(isset($department->manager)) {
			$old_manager = $department->manager;
			$old_manager->type = 0;
			$old_manager->save();
		}
		Department::where('id',$department_id)->update(['manager_id'=>$user_id]);
		User::where('id',$user_id)->update(['type'=>3,'department_id'=>$department_id]);

		$request->session()->flash('notice_msg','操作成功！');
		$request->session()->flash('notice_status','success');

		return redirect()->route('admin.department.show',['id'=>$department_id]);
	}

	// web, post
	public function dropDepartmentManager(Request $request){}

	// web, post
	public function alterDepartmentManager(Request $request){}

	// web, post
	public function alterDepartmentMembers(Request $request){
		$this->validate($request,[
			'user_ids' => 'required',
			'department_id' => 'required'
		]);
		$dpt_id = $request->get('department_id');

		$users = User::where('department_id',$dpt_id)->where('type',0)->get();
		$old_uids = [];
		foreach ($users as $user){
			array_push($old_uids,$user->id);
		}
		$u_ids  = $request->get('user_ids');

		foreach ( $u_ids as $u_id){
			User::where('id',$u_id)->update(['department_id'=>$dpt_id]);
		}
		foreach ($old_uids as $u_id){
			if(in_array($u_id, $u_ids)){
				continue;
			}
			User::where('id',$u_id)->update(['department_id'=>null]);
		}

		$request->session()->flash('notice_msg','操作成功！');
		$request->session()->flash('notice_status','success');
		return redirect()->route('admin.department.show',['id'=>$request->get('department_id')]);
	}
}
