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

Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', 'HomeController@index')->name('home');
});

/**
 * allow only superadministrators to access this route
 */
Route::group(['middleware'=>'auth',['role'=>'superadministrator']],function(){

    Route::get('/schools','SchoolController@index')->name('schools');
    Route::post('/school/store','SchoolController@store')->name('schoolStore');
    Route::post('/school/update','SchoolController@update')->name('SchoolUpdate');
    Route::get('/school/find','SchoolController@find')->name('SchoolName');
    Route::get('/school/{id}/edit','SchoolController@edit')->name('schoolEdit');
    Route::get('/school/{id}/details','SchoolController@details')->name('schoolView');
    Route::get('/school/create','SchoolController@create')->name('newSchool');
});
Route::get('/school/{id}','SchoolController@school')->name('school');
Route::get('/school/{id}/courses','CourseController@index')->name('schoolCourses');
Route::get('/school/{id}/subjects','SubjectController@index')->name('schoolSubjects');
Route::get('/school/{id}/forms','FormController@index')->name('schoolForms');
Route::get('/school/{id}/users','UserController@index')->name('schoolUsers');
Route::get('/school/{id}/students','SchoolController@students')->name('schoolStudents');

//courses
Route::post('/course/store','CourseController@store')->name('SchoolCourseStore');
Route::get('/course/find','CourseController@SubjectFind')->name('courseSubjects');
Route::get('/course/subjects','CourseController@subjects')->name('SubjectsCreate');

//subjects routes
Route::post('/subject/store','SubjectController@store')->name('subjectStore');
Route::get('/subject/{id}/enroll','SubjectController@enrollStudents')->name('SubjectEnroll');
Route::post('/subject/StudentEnrollStore','SubjectController@enrollStudentsstore')->name('subjEnrollStudent');
Route::get('/subject/{id}/members','SubjectController@members')->name('subjectMembers');
Route::get('/subjects','SubjectController@show')->name('userSubjects');
/**
 * use accessing subject
 */
Route::group(['middleware'=>'auth'],function(){
    Route::get('/school/subject/{id}','SubjectController@subjectDetails')->name('subject');
});

//form routes
Route::post('/form/store','FormController@store')->name('formStore');
Route::get('/forms/{id}/enroll','FormController@enrollStudents')->name('FormEnroll');
Route::post('/form/enroll/store','FormController@enrollStore')->name('enrollStudents');

//users Routes
Route::post('/user/store','UserController@store')->name('UserStore');
Route::post('/user/{id}/update','UserController@update')->name('UserUpdate');
Route::get('/school/{id}/teachers','SchoolController@SchoolTeachers')->name('SchoolTeachers');

/**
 * students find
 */
Route::get('/form/students','AjaxController@formStudents');


/**
 * terms
 */
Route::get('/school/{id}/terms','TermController@schoolTerm')->name('schoolTerms');
Route::post('/school/term/store','TermController@store')->name('termStore');