<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
    	return view('admin.project.index');
    }

    // web, get
	public function show(Request $request, $id){}

	// web, post
	public function pass(Request $request, $id){}

	// web, post
	public function reject(Request $request, $id){}
}
