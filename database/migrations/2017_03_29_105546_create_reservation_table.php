<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations',function(Blueprint $table){
        	$table->increments('id');
        	$table->unsignedInteger('user_id')->comment('申请人id');
			$table->string('subject',127)->comment('会议主题');
        	$table->unsignedInteger('number')->comment('会议人数');
	        $table->unsignedInteger('meeting_room_id')->comment('开会地点');
	        $table->timestamp('start')->nullable();
	        $table->timestamp('end')->nullable();
	        $table->text('users')->nullable()->comment('参会人，备用');
	        $table->text('ext')->nullable()->comment('备用');
	        $table->integer('status')->default(0)->comment('审核状态, 0:正在审核; 1:通过; 2:拒绝');
        	$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservations');
    }
}
