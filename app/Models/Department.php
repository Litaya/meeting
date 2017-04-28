<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';
    protected $fillable = [
    	'id',
	    'name',
	    'manager_id'
    ];

    public function manager(){
    	return $this->hasOne('App\User','id','manager_id');
    }
}
