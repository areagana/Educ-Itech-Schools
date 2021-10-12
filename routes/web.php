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
Route::get('/school/find','SchoolController@find')->name('SchoolName');


//courses
Route::post('/course/store','CourseController@store')->name('SchoolCourseStore');