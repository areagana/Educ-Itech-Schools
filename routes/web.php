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
    return view('myhome');
})->name('frontPage');

/**
 * routes to redirect to pages on the from page
 */
Route::get('/contacts','FrontPageController@contacts')->name('contacts');
Route::get('/services','FrontPageController@services')->name('services');
Route::get('/clients','FrontPageController@clients')->name('clients');
Route::get('/howto','FrontPageController@howto')->name('howto');
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
Route::get('/school/{id}/notice','SchoolController@notice')->name('schoolNotices');
Route::get('/school/{id}/timetables','SchoolController@timetables')->name('schoolTimetables');
Route::get('/school/{id}/assessment','SchoolController@assessment')->name('schoolAssessments');
Route::get('/school/{id}/schemes','SchoolController@schemes')->name('schoolSchemes');
Route::get('/school/{id}/calender','SchoolController@calender')->name('schoolCalender');

//courses
Route::post('/course/store','CourseController@store')->name('SchoolCourseStore');
Route::get('/course/find','CourseController@SubjectFind')->name('courseSubjects');
Route::get('/course/subjects','CourseController@subjects')->name('SubjectsCreate');

//subjects routes
Route::group(['middleware'=>'auth',['role'=>['superadministrator','administrator']]],function(){
    Route::post('/subject/store','SubjectController@store')->name('subjectStore');
    Route::get('/subject/{id}/enroll','SubjectController@enrollStudents')->name('SubjectEnroll');
    Route::post('/subject/StudentEnrollStore','SubjectController@enrollStudentsstore')->name('subjEnrollStudent');
});
Route::group(['middleware'=>'auth',['role'=>['student','teacher','ict-admin','administrator','school-administrator','superadministrator']]],function(){
    Route::get('/members/filter','SubjectController@filterMembers')->name('filterMembers');
    Route::get('/subject/massEnroll','SubjectController@massEnroll')->name('massEnrollment');
});
Route::get('/subject/{id}/members','SubjectController@members')->name('subjectMembers');
Route::get('/subjects','SubjectController@show')->name('userSubjects');
Route::get('/subject/{id}/notes','ModuleController@index')->name('subjectNotes');
Route::get('/subject/{id}/conferences','SubjectController@conferences')->name('subjectConferences');
Route::get('/subject/{id}/announcements','SubjectController@announcements')->name('subjectAnnouncements');
Route::get('/subject/{id}/grades','SubjectController@grades')->name('subjectGrades');
Route::get('/subject/{id}/people','SubjectController@people')->name('subjectMember');
Route::get('/subject/{id}/files','SubjectController@files')->name('subjectFiles');

/**
 * use accessing subject
 */
Route::group(['middleware'=>'auth'],function(){
    Route::get('/subject/{id}','SubjectController@subjectDetails')->name('subject');
});

//form routes
Route::post('/form/store','FormController@store')->name('formStore');
Route::get('/forms/{id}/enroll','FormController@enrollStudents')->name('FormEnroll');
Route::post('/form/enroll/store','FormController@enrollStore')->name('enrollStudents');
Route::post('/promote/students','FormController@promoteStudents')->name('promoteStudents');
Route::post('/unenroll/students','FormController@unEnrollFromSubject')->name('unEnrollStudents');

//users Routes
Route::post('/user/store','UserController@store')->name('UserStore');
Route::post('/user/{id}/update','UserController@update')->name('UserUpdate');
Route::get('/user/{id}/view','UserController@show')->name('userView');
Route::get('/user/edit/{id}','UserController@edit')->name('userEdit');
Route::get('/user/delete/{id}','UserController@destroy')->name('userDelete');
Route::get('/school/{id}/teachers','SchoolController@SchoolTeachers')->name('SchoolTeachers');

Route::post('/user/save','UserController@checkUpdate')->name('userCheck');

/**
 * students find
 */
Route::get('/form/students','AjaxController@formStudents');


/**
 * terms
 */
Route::get('/school/{id}/terms','TermController@schoolTerm')->name('schoolTerms');
Route::post('/school/term/store','TermController@store')->name('termStore');

/**
 * assignment routes
 */
Route::get('/subject/{id}/assignments','AssignmentController@index')->name('assignments');
Route::group(['middleware'=>'auth','role'=>['teacher','administrator','school-administrator','superadministrator','ict-admin']],function(){
    Route::get('/subject/{id}/assignments/create','AssignmentController@create')->name('CreateAssignments');
    Route::post('/assignment/store','AssignmentController@store')->name('storeAssignment');
    Route::get('/assignment/delete','AssignmentController@destroy')->name('DeleteAssignment');
    Route::get('/assignment/{id}/download','AssignmentController@downloadAssignment')->name('DownloadAssignment');
    Route::get('/assignment/{id}/grade','AssignmentController@gradeAssignment')->name('gradeAssignment');
    Route::get('/assignment/{id}/load','AssignmentController@gradeAssignmentLoaded')->name('gradeAssignmentLoaded');
    Route::get('/submission/grade/save','AssignmentController@saveGrade')->name('saveGrade');
    Route::get('/submission/comment/save','AssignmentController@saveComment')->name('saveComment');
});

Route::get('/subject/{id1}/assignment/{id2}','AssignmentController@show')->name('assignment.show');
Route::get('/subject/{id1}/assignment/{id2}/attempt','AssignmentController@attempt')->name('assignment.attempt');

Route::group(['middleware'=>'auth','role'=>['student','administrator','superadministrator','ict-admin','school-administrator']],function(){
    Route::post('/assignment/submission/store','AssignmentController@storeSubmitted')->name('storeSubmission');
});

/**
 * conferences routes
 */
Route::group(['middleware'=>'auth','role'=>['teacher','administrator','school-administrator','superadministrator','ict-admin']],function(){
    Route::post('/subject/conference/create','ConferenceController@store')->name('newConference');
});
// testing url
Route::get('/test/conferences','ConferenceController@test')->name('testurl');
Route::get('/barcode','HomeController@barcode')->name('barcode');


/**
 * subject modules
 */
Route::group(['middleware'=>'auth','role'=>['teacher','administrator','school-administrator','superadministrator','ict-admin']],function(){
    Route::get('/subject/{id}/modules','ModuleController@create')->name('module');
    Route::post('/subject/{id}/modules/store','ModuleController@store')->name('moduleStore');
    Route::get('/module/delete','ModuleController@destroy')->name('moduleDelete');
    Route::post('/notes/store','NoteController@store')->name('NoteStore');
    Route::get('/module/update','ModuleController@background')->name('ModuleColor');
    Route::get('/note/delete','NoteController@destroy')->name('NoteDelete');
});
Route::get('/module/notes/{id}','NoteController@show')->name('noteView');
Route::get('/module/notes/{id}/pdf','NoteController@createPDF')->name('CreatePDF');
Route::get('/module/notes/{id}/download','NoteController@downloadNotes')->name('downloadNotes');

//test how to open and read a document online
Route::get('/module/notes/{id}/open','NoteController@OpenNotes')->name('openNotes');

/**
 * calender routes
 */
Route::get('/calender','CalenderController@index')->name('calender');

/**
 * generate report
 */
Route::get('/account/academicreport/','ReportController@studentReport')->name('studentReport');
Route::get('/account/academicreport/pdf','ReportController@studentReportPDF')->name('studentReportPDF');
