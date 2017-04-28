<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';
    protected $fillable = [
    	'id',
	    'name',
	    'manager_id',
	    'desc'
    ];

	public function manager(){
		return $this->hasOne('App\User','id','manager_id');
	}
}
