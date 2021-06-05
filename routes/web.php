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

	Route::get('/student/getdetail/{id}', 'StudentController@getDetail')->name('student.edit');

	Route::post('/student/update', 'StudentController@update')->name('student.update');

	Route::get('/student/delete', 'StudentController@delete')->name('student.delete');



	//CLASS
	

	Route::get('/classsetup', 'ClassSetupController@index')->name('class.setup.index');

	Route::get('/classsetup/insert', 'ClassSetupController@create')->name('class.setup.insert');

	Route::post('/classsetup/insert', 'ClassSetupController@store')->name('class.setup.store');

	Route::get('/classsetup/getdetail/{id}', 'ClassSetupController@getDetail')->name('class.setup.edit');

	Route::post('/classsetup/update', 'ClassSetupController@update')->name('class.setup.update');

	Route::get('/classsetup/delete', 'ClassSetupController@delete')->name('class.setup.delete');



	//CLASS
	

	Route::get('/myclasssetup', 'MyClassSetupController@index')->name('my.class.setup.index');


	Route::get('/myclasssetup/getdetail/{id}', 'MyClassSetupController@getDetail')->name('my.class.setup.edit');


	//scan
	

	Route::get('/scan', 'ScanController@index')->name('scan.index');

	Route::get('/scan/searchstudent', 'ScanController@searchstudent')->name('scan.search.student');

	Route::post('/scan/timein', 'ScanController@timeIn')->name('scan.insert');


	//POPULATE CLASSES
	

	Route::get('/populateclass', 'PopulateClassController@index')->name('populate.class.setup.index');

	Route::get('/populateclass/insert', 'PopulateClassController@create')->name('populate.class.setup.insert');

	Route::post('/populateclass/insert', 'PopulateClassController@store')->name('populate.class.setup.store');

	Route::get('/populateclass/getdetail/{id}', 'PopulateClassController@getDetail')->name('populate.class.setup.edit');

	Route::post('/populateclass/update', 'PopulateClassController@update')->name('populate.class.setup.update');

	Route::get('/populateclass/delete', 'PopulateClassController@delete')->name('populate.class.setup.delete');


	//GENERATE ATTENDANCE

	Route::get('/generateAttendance', 'GenerateAttendanceController@index')->name('generate.attendance.index');

	Route::post('/generateAttendance/insert', 'GenerateAttendanceController@generate')->name('generate.attendance.post');

});