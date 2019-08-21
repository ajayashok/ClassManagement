<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


	Route::middleware(['logincheck'])->group(function ()
	 {
	 	Route::get('/home', 'HomeController@index')->name('home');

	});

	Route::middleware(['studentcheck'])->group(function ()
	 {
	 	Route::resource('student','StudentController');
	});

	Route::middleware(['admincheck'])->group(function ()
	 {
	    Route::resource('admin','AdminController');
	});

	Route::middleware(['teachercheck'])->group(function ()
	 {
	    Route::resource('teacher','TeacherController');
	});

	Route::resource('message','MessageController');

	Route::get('replyHistory','ApiController@getReplyHistory');
