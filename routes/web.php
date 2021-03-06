<?php

use App\Mail\Welcomemail;
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
 * checking email sending
 */
Route::post('/email',function(Request $request){
    //return new Welcomemail();
    Mail::to($request->input('email'))->send(new Welcomemail());
});

// send feedback message to the sender
Route::post('/sender','MessageController@sender')->name('sender');
Route::get('/messages','MessageController@fetchmessages')->name('messages');
Route::get('/message/read','MessageController@read')->name('messageRead');

Route::get('/changePassword','HomeController@passwordForm')->name('newPassword.form');
Route::post('/password/store','Homecontroller@changePassword')->name('changePassword');
// multiple upload users
Route::post('/users/upload','UserController@uploadUsers')->name('users.upload');

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
Route::get('/school/{id}/notice','AnnouncementController@index')->name('schoolNotices');
Route::get('/school/{id}/timetables','TimeTableController@index')->name('schoolTimetables');
Route::get('/school/{id}/assessment','SchoolController@assessments')->name('schoolAssessments');
Route::get('/school/{id}/schemes','SchemeController@index')->name('schoolSchemes');
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
Route::get('/subject/{id}/assessment','SubjectController@assessment')->name('subjectAssessments');

/**
 * user accessing subject
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
Route::get('/form/{id}/view','FormController@View')->name('formView');

//users Routes
Route::post('/user/store','UserController@store')->name('UserStore');
Route::get('/users/all','UserController@allUsers')->name('allUsers');
Route::post('/user/{id}/update','UserController@update')->name('UserUpdate');
Route::get('/user/{id}/view','UserController@show')->name('userView');
Route::get('/user/edit/{id}','UserController@edit')->name('userEdit');
Route::get('/user/delete/{id}','UserController@destroy')->name('userDelete');
Route::get('/school/{id}/teachers','SchoolController@SchoolTeachers')->name('SchoolTeachers');
Route::post('/account/activation','UserController@activateAccount')->name('accountActivation');
Route::post('/account/deactivation','UserController@suspendAccount')->name('accountActivation');
Route::post('/user/add/role','UserController@addRole')->name('addUserRole');
Route::post('/user/save','UserController@checkUpdate')->name('userCheck');

/**
 * students find/ajax routes
 */
Route::get('/form/students','AjaxController@formStudents');
Route::get('/subjects/find','AjaxController@subjectFind')->name('formsubjectsfind');
Route::get('/term/notice','AjaxController@termNotice')->name('termNotice');


/**
 * terms
 */
Route::get('/school/{id}/terms','TermController@schoolTerm')->name('schoolTerms');
Route::post('/school/term/store','TermController@store')->name('termStore');
Route::post('/school/term/upadate','TermController@update')->name('termUpdate');
Route::get('/term/delete','TermController@destroy')->name('termDelete');

/**
 * assignment routes
 */
Route::get('/subject/{id}/assignments','AssignmentController@index')->name('assignments');
Route::group(['middleware'=>'auth','role'=>['teacher','administrator','school-administrator','superadministrator','ict-admin']],function(){
    Route::get('/subject/{id}/assignments/create','AssignmentController@create')->name('CreateAssignments');
    Route::post('/assignment/store','AssignmentController@store')->name('storeAssignment');
    Route::post('/assignment/update','AssignmentController@update')->name('updateAssignment');
    Route::get('/assignment/delete','AssignmentController@destroy')->name('DeleteAssignment');
    Route::get('/assignment/{id}/download','AssignmentController@downloadAssignment')->name('DownloadAssignment');
    Route::get('/assignment/{id}/grade','AssignmentController@gradeAssignment')->name('gradeAssignment');
    Route::get('/assignment/{id}/load','AssignmentController@gradeAssignmentLoaded')->name('gradeAssignmentLoaded');
    Route::get('/submission/grade/save','AssignmentController@saveGrade')->name('saveGrade');
    Route::get('/submission/comment/save','AssignmentController@saveComment')->name('saveComment');
    Route::post('/submission/feedback','AssignmentController@saveFeedback')->name('submissionFeedback');
    Route::get('/assignment/feedback/{id}','AssignmentController@displayFeedback')->name('showFeedback');
    Route::get('/assignment/feedback/{id}/{name}','AssignmentController@viewFeedback')->name('ViewFeedback');
    Route::get('/assignment/submission/{id}/{name}','AssignmentController@viewSubmission')->name('viewSubmission');
    Route::post('/feedback/comment/delete','AssignmentController@commentDelete')->name('commentDelete');
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

/**
 * timetables routes
 */
Route::get('/timetables','TimeTableController@index')->name('timetables');
Route::get('/timetables/view','TimeTableController@view')->name('viewTimetables');
Route::post('/timetables/store','TimeTableController@store')->name('storeTimetables');
Route::get('/timetable/{id}/download','TimeTableController@downloadTimetable')->name('DownloadTimetable');
Route::get('/timetable/{id}/view','TimeTableController@viewFile')->name('viewTimetable');
Route::get('/timetable/delete','TimeTableController@destroy')->name('timetableDelete');

/**
 * scheme routes
 */
Route::post('/store/schemes','SchemeController@store')->name('storeSchemes');
Route::get('/scheme/{id}/download','SchemeController@downloadScheme')->name('DownloadScheme');
Route::get('/scheme/{id}/view','SchemeController@viewFile')->name('viewScheme');
Route::get('/scheme/delete','SchemeController@destroy')->name('schemeDelete');
Route::get('/subject/{id}/schemes','SchemeController@subjectSchemes')->name('subjectSchemes');

/**
 * exams Routes
 */
Route::post('/exam/store','ExamController@store')->name('examStore');
Route::get('/exam/delete','ExamController@destroy')->name('examDelete');

/**
 * exam results routes
 */
Route::post('/exam/results/store','ExamResultsController@store')->name('markStore');
Route::post('/exam/results/update','ExamResultsController@update')->name('markUpdate');

/**
 * start conference
 */
Route::post('/url','ConferenceController@openConference')->name('startConference');
Route::post('/conference/delete','ConferenceController@destroy')->name('deleteConference');
Route::post('/conference/start','ConferenceController@startConference')->name('startConferences');
Route::post('/conference/end','ConferenceController@endConference')->name('endConferences');
Route::post('/conference/video','ConferenceController@addVideo')->name('addVideo');

/**
 * log activity routes
 */
Route::get('add-to-log', 'HomeController@myTestAddToLog');
Route::get('logActivity', 'HomeController@logActivity');

/**
 * announcements;
 */
Route::post('/Announcement/store','AnnouncementController@store')->name('announcement.store');
Route::get('/Announcement/{id}/download','AnnouncementController@download')->name('announcement.download');
Route::get('/ann/delete','AnnouncementController@destroy')->name('Ann.delete');
Route::get('/notices','AnnouncementController@userview')->name('ann.user');

/**
 * category routes
 */
Route::get('/categories','CategoryController@index')->name('categories');
Route::post('/category/store','CategoryController@store')->name('store.category');
Route::get('/category/delete','CategoryController@destroy')->name('category.delete');
Route::get('/watch/{id}','ConferenceController@watchVideo')->name('videoWatch');

/**
 * marksheet view
 */
Route::get('/exam/{id}','ReportController@marksheetView')->name('marksheet');
Route::get('/marksheetView','Reportcontroller@loadMarksheet')->name('marksheetView');
Route::get('/gradesheetView/{id}','Reportcontroller@gradesheet')->name('gradesheetView');

// exam report routes
Route::get('/form/{id}/reports','ReportController@examReport')->name('examReport');

// texting sms system
Route::post('/sms','MessageController@smsMessages')->name('smsMessages');