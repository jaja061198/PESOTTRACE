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
    return view('auth.login');
});

Auth::routes();

Route::get('/studentQR', 'StudentController@studentQR')->name('student.qr.index');

Route::post('/studentQRGenerate', 'StudentController@studentQRGenerate')->name('student.qr.generate');

Route::group(['middleware' => 'auth'] , function() {

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/users', 'UserController@index')->name('users.index');

	Route::get('/users/insert', 'UserController@insert')->name('users.insert');

	Route::get('/users/getdetail', 'UserController@getDetail')->name('users.edit');

	Route::get('/users/update', 'UserController@update')->name('users.update');

	Route::get('/users/delete', 'UserController@delete')->name('users.delete');

	//GRADE
	

	Route::get('/grade', 'GradeController@index')->name('grade.index');

	Route::get('/grade/insert', 'GradeController@insert')->name('grade.insert');

	Route::get('/grade/getdetail', 'GradeController@getDetail')->name('grade.edit');

	Route::get('/grade/update', 'GradeController@update')->name('grade.update');

	Route::get('/grade/delete', 'GradeController@delete')->name('grade.delete');




	//SECTION
	

	Route::get('/section', 'SectionController@index')->name('section.index');

	Route::get('/section/insert', 'SectionController@insert')->name('section.insert');

	Route::get('/section/getdetail', 'SectionController@getDetail')->name('section.edit');

	Route::get('/section/update', 'SectionController@update')->name('section.update');

	Route::get('/section/delete', 'SectionController@delete')->name('section.delete');


	//STUDENT
	

	Route::get('/student', 'StudentController@index')->name('student.index');

	Route::get('/student/insert', 'StudentController@create')->name('student.insert');

	Route::post('/student/insert', 'StudentController@store')->name('student.store');

	Route::get('/student/getdetail', 'StudentController@getDetail')->name('student.edit');

	Route::get('/student/update', 'StudentController@update')->name('student.update');

	Route::get('/student/delete', 'StudentController@delete')->name('student.delete');


	//scan
	

	Route::get('/scan', 'ScanController@index')->name('scan.index');

	Route::get('/scan/insert', 'ScanController@insert')->name('scan.insert');

	Route::get('/scan/getdetail', 'ScanController@getDetail')->name('scan.edit');

	Route::get('/scan/update', 'ScanController@update')->name('scan.update');

	Route::get('/scan/delete', 'ScanController@delete')->name('scan.delete');


});