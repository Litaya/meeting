<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(){
    	$user    = Auth::user();
    	$pojects = Project::where('manager_id',$user->id)->get();
    	return view('project.index');
    }
}
