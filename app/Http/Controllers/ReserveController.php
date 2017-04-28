<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReserveController extends Controller
{
    public function index(){
		return view('reserve.apply');
    }

    // 存储预约
    public function store(Request $request){
		$this->validate($request,[
			'subject' => 'required',
			'number'  => 'required',
			'address' => 'required',
			'start_datetime' => 'required',
			'end_datetime'   => 'required'
		]);

		// TODO 验证输入是否合法
	    // TODO 预约时间段是否合法

		$user = Auth::user();
		Reservation::create([
			'user_id'         => $user->id,
			'subject'         => $request->get('subject'),
			'number'          => $request->get('number'),
			'meeting_room_id' => $request->get('address'),
			'start'           => $request->get('start_datetime'),
			'end'             => $request->get('end_datetime')
		]);
		$request->session()->flash('message','预约成功!');
		$request->session()->flash('status','success');
	    return redirect()->route('reserve.record');
    }

    public function record(Request $request){
    	$user_id = Auth::user()->id;
    	$reservations = Reservation::orderBy('status','desc')->get();
		return view('reserve.record',compact('reservations'));
    }

    public function cancel(Request $request,$id){
    	$reservation = Reservation::where('id',$id)->first();
    	$reservation->status = -1;
    	$reservation->save();

    	$request->session()->flash('message','取消成功');
    	$request->session()->flash('status','success');

    	return redirect()->route('reserve.record');
    }
}
