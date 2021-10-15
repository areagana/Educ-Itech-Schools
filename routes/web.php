<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home','HomeController@index')->name('home');

Route::get('/schools','SchoolController@index')->name('schools');
Route::post('/school/store','SchoolController@store')->name('schoolStore');
Route::post('/school/update','SchoolController@update')->name('SchoolUpdate');
Route::get('/school/find','SchoolController@find')->name('SchoolName');
Route::get('/school/{id}/edit','SchoolController@edit')->name('schoolEdit');
Route::get('/school/{id}/details','SchoolController@details')->name('schoolView');
Route::get('/school/create','SchoolController@create')->name('newSchool');
Route::get('/school/{id}/courses','CourseController@index')->name('schoolCourses');
Route::get('/school/{id}/subjects','SubjectController@index')->name('schoolSubjects');
Route::get('/school/{id}/forms','FormController@index')->name('schoolForms');
Route::get('/school/{id}/users','UserController@index')->name('schoolUsers');



//courses
Route::post('/course/store','CourseController@store')->name('SchoolCourseStore');
Route::get('/course/find','CourseController@SubjectFind')->name('courseSubjects');
Route::get('/course/subjects','CourseController@subjects')->name('SubjectsCreate');

//subjects routes
Route::post('/subject/store','SubjectController@store')->name('subjectStore');

//form routes
Route::post('/form/store','FormController@store')->name('formStore');

//users Routes
Route::post('/user/store','UserController@store')->name('UserStore');
Route::post('/user/{id}/update','UserController@update')->name('UserUpdate');