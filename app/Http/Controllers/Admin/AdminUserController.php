<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(){
    	$users = User::paginate(10);
    	return view('admin.user.index',compact('users'));
    }
}
