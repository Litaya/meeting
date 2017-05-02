<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index(Request $request){
    	$user = Auth::user();
    	$codept_users = [];
    	if(isset($user->department_id)){
    		$codept_users = User::where('department_id',$user->department_id)->get();
	    }
    	return view('department.index',compact('user','codept_users'));
    }
}
