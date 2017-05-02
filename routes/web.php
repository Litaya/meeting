<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
	return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>['auth','permission']],function(){
	Route::get('/','Admin\AdminController@index')->name('admin.index');

	Route::get('/user','Admin\AdminUserController@index')->name('admin.user.index');

	Route::group(['prefix'=>'department'],function () {
		Route::get('/','Admin\DepartmentController@index')->name('admin.department.index');
		Route::get('/{id}','Admin\DepartmentController@show')->name('admin.department.show');
		Route::post('/create','Admin\DepartmentController@create')->name('admin.department.create');
		Route::post('/{id}/drop','Admin\DepartmentController@drop')->name('admin.department.drop');
		Route::get('/{id}/{user_id}/remove','Admin\DepartmentController@removeMember')->name('admin.department.remove_member');
		Route::post('/{id}/add_members','Admin\DepartmentController@addMembers')->name('admin.department.add_members');
	});

	Route::group(['prefix'=>'project'],function () {
		Route::get('/','Admin\ProjectController@index')->name('admin.project.index');

		Route::get('/{id}','Admin\ProjectController@show')->name('admin.project.show');
		Route::post('/{id}/pass','Admin\ProjectController@pass')->name('admin.project.pass');
		Route::post('/{id}/reject','Admin\ProjectController@reject')->name('admin.project.reject');
	});

	Route::group(['prefix'=>'meeting'],function () {
		Route::get('/','Admin\AdminMeetingController@index')->name('admin.meeting.index');
	});

	Route::group(['prefix'=>'meeting-room'],function () {
		Route::get('/','Admin\AdminMeetingRoomController@index')->name('admin.meeting-room.index');

		Route::post('/create','Admin\AdminMeetingRoomController@create')->name('admin.meeting-room.create');
		Route::get('/{id}','Admin\AdminMeetingRoomController@show')->name('admin.meeting-room.show');
		Route::post('/{id}/alter','Admin\AdminMeetingRoomController@alter')->name('admin.meeting-room.alter');
		Route::post('/{id}/drop','Admin\AdminMeetingRoomController@drop')->name('admin.meeting-room.drop');
	});

	Route::group(['prefix'=>'privilege'],function (){
		Route::get('/','Admin\PrivilegeController@index')->name('admin.privilege.index');
		Route::get('/setposition','Admin\PrivilegeController@setUserType')->name('admin.privilege.setposition');
		Route::get('/dropposition','Admin\PrivilegeController@depriveUserPrivilege')->name('admin.privilege.dropposition');

		Route::group(['prefix'=>'dept'],function () {
			Route::post('/setmanager', 'Admin\PrivilegeController@setDepartmentManager')->name('admin.privilege.dept.setmanager');
			Route::post('/dropmanager', 'Admin\PrivilegeController@dropDepartmentManager')->name('admin.privilege.dept.dropmanager');
			Route::post('/altermanager', 'Admin\PrivilegeController@alterDepartmentManager')->name('admin.privilege.dept.altermanager');
		});
		Route::group(['prefix'=>'project'],function () {
			Route::post('/setmanager', 'Admin\PrivilegeController@setProjectManager')->name('admin.privilege.project.setmanager');
			Route::post('/dropmanager', 'Admin\PrivilegeController@dropProjectManager')->name('admin.privilege.project.dropmanager');
			Route::post('/altermanager', 'Admin\PrivilegeController@alterProjectManager')->name('admin.privilege.project.altermanager');
		});
	});
});

Route::group(['prefix'=>'reserve','middleware'=>['auth','permission']],function (){
	Route::get('/','ReserveController@index')->name('reserve.index');
	Route::get('/{id}','ReserveController@show')->name('reserve.show');
	Route::post('/','ReserveController@store')->name('reserve.store');
	Route::get('/record','ReserveController@record')->name('reserve.record');
	Route::get('/record/{id}/cancel','ReserveController@cancel')->name('reserve.cancel');

	Route::post('/{id}/apply','ReserveController@apply')->name('reserve.apply'); // 用户申请参加会议
	Route::post('/{id}/{user_id}/accept','ReserveController@accept')->name('reserve.accept'); // 同意用户申请参加会议
	Route::post('/{id}/{user_id}/reject','ReserveController@reject')->name('reserve.reject'); // 拒绝用户申请参加会议
});

Route::group(['prefix'=>'department','middleware'=>['auth','permission']],function (){
	Route::get('/','DepartmentController@index')->name('department.index');

	Route::group(['prefix'=>'privilege'],function () {
		Route::post('/setassistant','DepartmentController@setAssistant')->name('department.privilege.setassistant');
		Route::post('/dropassistant','DepartmentController@dropAssistant')->name('department.privilege.dropassistant');
		Route::post('/alterassistant','DepartmentController@alterAssistant')->name('department.privilege.alterassistant');
	});
});

Route::group(['prefix'=>'project','middleware'=>['auth','permission']],function (){
	Route::get('/','ProjectController@index')->name('project.index');
	Route::get('/{id}','ProjectController@show')->name('project.show');
	Route::post('/create','ProjectController@create')->name('project.create');
	Route::post('/{id}/submit','ProjectController@submit')->name('project.submit');

	Route::group(['prefix'=>'privilege'],function () {
		Route::post('/setassistant','ProjectController@setAssistant')->name('project.privilege.setassistant');
		Route::post('/dropassistant','ProjectController@dropAssistant')->name('project.privilege.dropassistant');
		Route::post('/alterassistant','ProjectController@alterAssistant')->name('project.privilege.alterassistant');

		Route::post('/{id}/addmembers','ProjectController@addMembers')->name('project.privilege.addmembers');
		Route::post('/{id}/dropmembers','ProjectController@dropMembers')->name('project.privilege.dropmembers');
	});
});

Route::group(['prefix'=>'user','middleware'=>['auth','permission']],function (){
	Route::get('/','UserController@index')->name('user.index');
});
