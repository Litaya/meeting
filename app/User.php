<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'department_id', 'project_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function reservations(){
		return $this->hasMany('App\Models\Reservation', 'user_id', 'id');
	}

	public function department(){
		return $this->belongsTo('App\Models\Department', 'department_id','id');
	}

	public function project(){
		return $this->belongsTo('App\Models\Project', 'project_id','id');
	}
}
