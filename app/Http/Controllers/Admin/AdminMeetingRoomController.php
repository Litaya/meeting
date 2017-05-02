<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMeetingRoomController extends Controller
{
    public function index(){
    	return view('admin.meeting-room.index');
    }

    // web, post
    public function create(Request $request){}

	// web, get
	public function show(Request $request, $id){}

	// web, post
	public function alter(Request $request, $id){}

	// web, post
	public function drop(Request $request, $id){}

}
