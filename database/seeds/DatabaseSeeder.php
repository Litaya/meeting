<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('users')->insert([
		    'id'       => 1,
		    'type'     => 1,
		    'name'     => '李小可',
		    'email'    => 'shococo@163.com',
		    'password' => bcrypt('shococo')
	    ]);
	    DB::table('users')->insert([
		    'id'       => 2,
		    'type'     => 0,
		    'name'     => '张馨如',
		    'email'    => 'user@163.com',
		    'password' => bcrypt('secret')
	    ]);
    }
}
