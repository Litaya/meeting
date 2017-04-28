<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $fillable = [
    	'id',
	    'user_id',
	    'subject',
	    'number', //参会人数
	    'meeting_room_id', //会议地点
	    'start',
	    'end',
	    'users',
	    'ext'
    ];

	public function user(){
		return $this->belongsTo('App\User', 'user_id', 'id');
	}
}
