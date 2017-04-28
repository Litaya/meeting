<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
	public function index(){
		$departments = Department::all();
		$users = User::where('type',0)->get();
		return view('admin.department.index',compact('departments','users'));
	}

	public function show(Request $request,$id){
		$department = Department::where('id',$id)->first();
		$members    = User::where('department_id',$id)->where('type',0)->get();
		$users      = User::where('type',0)->get();
		return view('admin.department.show',compact('department','members','users'));
	}

	public function create(Request $request){
		$this->validate($request,[
			'name' => 'required',
			'manager' => 'required'
		]);

		$name       = $request->get('name');
		$manager_id = $request->get('manager');

		$department = Department::where('name',$name)->get();
		if(sizeof($department) > 0) {
			$request->session()->flash('notice_msg', '添加失败，部门名称重复！');
			$request->session()->flash('notice_status', 'danger');
			return redirect()->route('admin.department.index');
		}

		$manager    = User::where('id',$manager_id)->first();
		$checked    = true;
		$notice_msg = '';
		if(empty($manager)){
			$checked    = false;
			$notice_msg = '添加失败，部门负责人不合法！';
		}
		if($checked && $manager->type !== 0 ){
			$checked    = false;
			$notice_msg = '添加失败，要设置为部门负责人的用户已有身份！';
		}
		if(!$checked){
			$request->session()->flash('notice_msg', $notice_msg);
			$request->session()->flash('notice_status', 'danger');
			return redirect()->route('admin.department.index');
		}

		$department = Department::create([
			'name'       => $name,
			'manager_id' => $manager_id
		]);

		$manager->type = 3; // 设置用户为部门负责人
		$manager->department_id = $department->getAttribute('id');
		$manager->save();

		$request->session()->flash('notice_msg','操作成功！');
		$request->session()->flash('notice_status','success');
		return redirect()->route('admin.department.index');
	}

	public function drop(Request $request, $id){
		Department::where('id',$id)->delete();
		User::where('department_id',$id)->update(['type'=>0,'department_id'=>null]);

		$request->session()->flash('notice_msg','操作成功！');
		$request->session()->flash('notice_status','success');
		return redirect()->route('admin.department.index');
	}

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

	public function removeMember(Request $request, $id, $user_id){
		User::where('id',$user_id)->where('department_id',$id)->update(['department_id'=>null]);

		$request->session()->flash('notice_msg','操作成功！');
		$request->session()->flash('notice_status','success');

		return redirect()->route('admin.department.show',['id'=>$id]);
	}

	public function alterMembers(Request $request){
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
