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
	Route::get('/meeting','Admin\AdminMeetingController@index')->name('admin.meeting.index');
	Route::get('/meeting-room','Admin\AdminMeetingRoomController@index')->name('admin.meeting-room.index');

	Route::group(['prefix'=>'department'],function () {
		Route::get('/','Admin\DepartmentController@index')->name('admin.department.index');
		Route::post('/create','Admin\DepartmentController@create')->name('admin.department.create');
		Route::get('/{id}','Admin\DepartmentController@show')->name('admin.department.show');
		Route::get('/{id}/drop','Admin\DepartmentController@drop')->name('admin.department.drop');
		Route::get('/{id}/{user_id}/remove','Admin\DepartmentController@removeMember')->name('admin.department.remove_member');
		Route::post('/setmanager','Admin\DepartmentController@setDepartmentManager')->name('admin.department.set_manager');
		Route::post('/altermembers','Admin\DepartmentController@alterMembers')->name('admin.department.alter_members');

	});

	Route::group(['prefix'=>'project'],function () {
		Route::get('/','Admin\ProjectController@index')->name('admin.project.index');
	});

	Route::group(['prefix'=>'meeting'],function () {
		Route::get('/','Admin\AdminMeetingController@index')->name('admin.meeting.index');
	});

	Route::group(['prefix'=>'meeting-room'],function () {
		Route::get('/','Admin\AdminMeetingRoomController@index')->name('admin.meeting-room.index');
	});

	Route::group(['prefix'=>'privilege'],function (){
		Route::get('/','Admin\PrivilegeController@index')->name('admin.privilege.index');
		Route::get('/setposition','Admin\PrivilegeController@setUserType')->name('admin.privilege.setposition');
		Route::get('/dropposition','Admin\PrivilegeController@depriveUserPrivilege')->name('admin.privilege.dropposition');

		Route::group(['prefix'=>'dept'],function () {
			Route::post('/setmanager', 'Admin\PrivilegeController@setDepartmentManager')->name('admin.privilege.dept.setmanager');
			Route::post('/dropmanager', 'Admin\PrivilegeController@dropDepartmentManager')->name('admin.privilege.dept.dropmanager');
		});
		Route::group(['prefix'=>'project'],function () {
			Route::post('/setmanager', 'Admin\PrivilegeController@setProjectManager')->name('admin.privilege.project.setmanager');
			Route::post('/dropmanager', 'Admin\PrivilegeController@dropProjectManager')->name('admin.privilege.project.dropmanager');
		});
	});
});

Route::group(['prefix'=>'reserve','middleware'=>['auth','permission']],function (){
	Route::get('/','ReserveController@index')->name('reserve.index');
	Route::post('/','ReserveController@store')->name('reserve.store');
	Route::get('/record','ReserveController@record')->name('reserve.record');
	Route::get('/record/{id}/cancel','ReserveController@cancel')->name('reserve.cancel');
});

Route::group(['prefix'=>'department','middleware'=>['auth','permission']],function (){
	Route::get('/','DepartmentController@index')->name('department.index');

});

Route::group(['prefix'=>'project','middleware'=>['auth','permission']],function (){
	Route::get('/','ProjectController@index')->name('project.index');
});