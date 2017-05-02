<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request){
    	$user    = Auth::user();
    	$pojects = Project::where('manager_id',$user->id)->get();
    	return view('project.index');
    }

	public function show(Request $request, $id){}

    // web post
	// 创建一个，对应于前端的"保存按钮"
    public function create(Request $request){}

	// web post
	// 提交保存的项目及记录
	public function submit(Request $request, $id){}

    // web post
    public function setAssistant(Request $request){}

	// web post
	public function dropAssistant(Request $request){}

	// web post
	public function alterAssistant(Request $request){}

	// TODO check: whether user has specific project permission
	public function addMembers(Request $request, $id){}

	// TODO check: whether user has specific project permission
	public function dropMembers(Request $request, $id){}

}
