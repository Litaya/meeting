<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\User;
use Illuminate\Http\Request;

class AdminMeetingController extends Controller
{
    public function index(){
	    $reservations = Reservation::orderBy('created_at','desc')->get();
	    $users        = User::all();
    	return view('admin.meeting.index',compact('reservations','users'));
    }
}
