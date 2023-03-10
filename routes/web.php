<?php

use App\Mail\Welcomemail;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\PDF;

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

Route::get('/pdf','PdfController@pdf')->name('pdf');
Route::get('/mksheet','PdfController@mksheetView')->name('mksheet');
Route::post('/pdfreport','PdfController@pdfReport')->name('pdfreport');
Route::get('/pdfreportDownload/{formid}/{examid}/{streamid?}','PdfController@pdfReportDownload')->name('pdfreportD');

// send feedback message to the sender
Route::post('/sender','MessageController@sender')->name('sender');
Route::get('/messages','MessageController@fetchmessages')->name('messages');
Route::get('/message/read','MessageController@read')->name('messageRead');

Route::get('/changePassword','HomeController@passwordForm')->name('newPassword.form');
Route::post('/password/store','HomeController@changePassword')->name('changePassword');
// multiple upload users
Route::post('/users/upload','UserController@uploadUsers')->name('users.upload');
Route::get('/school/{id}/user/create','UserController@create')->name('userCreate');

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
Route::group(['middleware'=>'auth',['role'=>'superadministrator','administrator']],function(){
    Route::get('/schools','SchoolController@index')->name('schools');
    Route::post('/school/store','SchoolController@store')->name('schoolStore');
    Route::post('/school/update','SchoolController@update')->name('SchoolUpdate');
    Route::get('/school/find','SchoolController@find')->name('SchoolName');
    Route::get('/school/{id}/edit','SchoolController@edit')->name('schoolEdit');
    Route::get('/school/{id}','SchoolController@school')->name('school');
    Route::get('/school/{id}/courses','CourseController@index')->name('schoolCourses');
    Route::get('/school/{id}/details','SchoolController@details')->name('schoolView');
    Route::get('/schooladd','SchoolController@create')->name('addSchool');
});


Route::group(['middleware'=>'auth',['role'=>['superadministrator','administrator','ict-admin','school-administrator']]],function(){
    Route::get('/school/{id}/profile','SchoolController@edit')->name('schoolProfile');
    Route::get('/school/{id}/levels','LevelController@index')->name('schoolLevels');
    Route::get('/school/{id}/levels/create','LevelController@create')->name('LevelCreate');
    Route::post('/school/{id}/levels/store','LevelController@store')->name('LevelStore');
    Route::get('/level/{id}/edit','LevelController@edit')->name('LevelEdit');
    Route::post('/level/{id}/update','LevelController@update')->name('LevelUpdate');
    Route::get('/levels/{id}/delete','LevelController@destroy')->name('LevelDelete');
    Route::get('/level/data','LevelController@levelData')->name('levelData');

    // marksheets routes
    Route::get('/marksheet/{id}','MarksheetController@index')->name('marksheetGenerate');
    Route::get('/gradesheet/{id}','MarksheetController@gdsheet')->name('gradesheetGenerate');
});

Route::get('/school/{id}/forms','FormController@index')->name('schoolForms');
Route::get('/school/{id}/users','UserController@index')->name('schoolUsers');
Route::get('/school/{id}/students','StudentController@index')->name('schoolStudents');
Route::get('/students','StudentController@index')->name('students');
Route::get('/school/{id}/notice','AnnouncementController@index')->name('schoolNotices');
Route::get('/school/{id}/timetables','TimeTableController@index')->name('schoolTimetables');
Route::get('/school/{id}/assessment','SchoolController@assessments')->name('schoolAssessments');
Route::get('/school/{id}/schemes','SchemeController@index')->name('schoolSchemes');
Route::get('/school/{id}/calender','SchoolController@calender')->name('schoolCalender');

/**
 * students Routes
 */
Route::group(['middleware'=>'auth','role'=>['superadministrator','administrator']],function(){
    Route::get('/student/create/{id}','StudentController@create')->name('student.create');
    Route::post('/student/store/{id}','StudentController@store')->name('student.store');
    Route::get('/students/{id}/edit','StudentController@edit')->name('studentEdit');
    Route::get('/students/{id}/view','StudentController@show')->name('studentShow');
    Route::post('/student/{id}/update','StudentController@update')->name('studentUpdate');
    Route::get('/student/delete/{id}','StudentController@destroy')->name('studentDelete');
    Route::get('/student/search','StudentController@search')->name('searchStudent');
});
//courses
Route::post('/course/store','CourseController@store')->name('SchoolCourseStore');
Route::get('/course/find','CourseController@SubjectFind')->name('courseSubjects');
Route::get('/course/subjects','CourseController@subjects')->name('SubjectsCreate');

//subjects routes
Route::group(['middleware'=>'auth',['role'=>['superadministrator','administrator']]],function(){
    Route::get('/school/{id}/subjects','SubjectController@index')->name('schoolSubjects');
    Route::post('/subject/store','SubjectController@store')->name('subjectStore');
    Route::get('/subject/{id}/enroll','SubjectController@enrollStudents')->name('SubjectEnroll');
    Route::get('/subject/{id}/edit','SubjectController@edit')->name('subjectEdit');
    Route::post('/subject/{id}/update','SubjectController@update')->name('subjectUpdate');
    Route::post('/subject/StudentEnrollStore','SubjectController@enrollStudentsstore')->name('subjEnrollStudent');
    Route::get('/subject/delete','SubjectController@destroy')->name('subjectDelete');
    Route::get('/subject/papers','SubjectController@papers')->name('subjectpapers');
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
Route::get('/card/{id}/assessment','SubjectController@assessment')->name('subjectAssessments');
Route::get('/formList','DashcardController@formList')->name('formList');
Route::post('/teacher/{id}/add-card','DashcardController@userCard')->name('addCard');
Route::get('/card/{id}/edit','DashcardController@edit')->name('cardEdit');
Route::post('/card/{id}/update','DashcardController@update')->name('cardUpdate');
Route::get('/card/delete','DashcardController@destroy')->name('cardDelete');

/**
 * subject topics and results routes
 */
Route::get('/subject/{id}/topics','TopicController@index')->name('subjectTopics');
Route::get('/card/{id1}/topic/{id2}/update','TopicController@markUpdate')->name('topicUpdate');
Route::post('/courseworkupdate/{id}','CourseworkController@store')->name('topicMarkUpdate');
Route::post('/topic/save','TopicController@store')->name('topicSave');
Route::get('/card/{id}/coursework','DashcardController@coursework')->name('subjectCoursework');
Route::get('/card/{id}/markupdate','DashcardController@markUpdate')->name('resultUpdate');
Route::get('/teacher/{id}/enroll','DashcardController@teacherEnroll')->name('teacherEnroll');

/**
 * user accessing subject
 */
Route::group(['middleware'=>'auth'],function(){
    Route::get('/subject/{id}','SubjectController@subjectDetails')->name('subject');
    Route::get('/card/{id}','DashcardController@index')->name('card');
});

//form routes
Route::post('/form/store','FormController@store')->name('formStore');
Route::get('/forms/{id}/enroll','FormController@enrollStudents')->name('FormEnroll');
Route::get('/forms/{id}/delete','FormController@destroy')->name('FormDelete');
Route::get('/form/{id}/edit','FormController@edit')->name('FormEdit');
Route::post('/form/{id}/sync','FormController@sync')->name('FormSync');
Route::post('/form/{id}/update','FormController@update')->name('formUpdate');

Route::post('/form/enroll/store','FormController@enrollStore')->name('enrollStudents');
Route::post('/promote/students','FormController@promoteStudents')->name('promoteStudents');
Route::post('/unenroll/students','FormController@unEnrollFromSubject')->name('unEnrollStudents');
Route::get('/form/{id}/view','FormController@View')->name('formView');

// stream Routes
Route::get('/streams','StreamController@index')->name('Streams');
Route::get('/stream/create','StreamController@create')->name('StreamCreate');
Route::get('/stream/{id}/edit','StreamController@edit')->name('StreamEdit');
Route::post('/stream/store','StreamController@store')->name('StoreStream');
Route::get('/stream/{id}/delete','StreamController@destroy')->name('StreamDelete');


//users Routes
Route::post('/user/store','UserController@store')->name('UserStore');
Route::get('/users/all','UserController@allUsers')->name('allUsers');
Route::get('/students/all','studentController@allStudents')->name('allStudents');
Route::post('/user/{id}/update','UserController@update')->name('UserUpdate');
Route::get('/user/{id}/view','UserController@show')->name('userView');
Route::get('/user/edit/{id}','UserController@edit')->name('userEdit');
Route::get('/user/delete/{id}','UserController@destroy')->name('userDelete');
Route::get('/school/{id}/teachers','SchoolController@SchoolTeachers')->name('SchoolTeachers');
Route::post('/account/activation','UserController@activateAccount')->name('activateAccount');
Route::post('/account/deactivation','UserController@suspendAccount')->name('deactivateAccount');
Route::post('/user/add/role','UserController@addRole')->name('addUserRole');
Route::post('/user/save','UserController@checkUpdate')->name('userCheck');

/**
 * students find/ajax routes
 */
Route::get('/form/students','AjaxController@formStudents');
Route::get('/subjects/find','AjaxController@subjectFind')->name('formsubjectsfind');
Route::get('/term/notice','AjaxController@termNotice')->name('termNotice');

/**
 * export students template  file
 */
Route::post('/school/{id}/studentExport','StudentController@exportCsv')->name('StudentTemplate');
Route::post('/school/{id}/studentUpload','StudentController@uploadStudents')->name('StudentUpload');


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
Route::get('/card/{id1}/exam/{id2}/marks','DashcardController@enterResults')->name('examMarks');

/**
 * exam results routes
 */
Route::post('/exam/results/store','ExamResultsController@store')->name('markStore');
Route::post('/exam/results/update','ExamResultsController@update')->name('markUpdate');
Route::post('/exam/results/updateAdmin','ExamResultsController@updateAdmin')->name('markUpdateAdmin');


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
Route::get('/exam/{id}','ExamController@show')->name('marksheet');
Route::post('/marksheetView','marksheetController@markSheetview')->name('marksheetView');
Route::post('/gradesheetView','marksheetController@gradeSheetview')->name('gradeSheetView');

// update subject results by admin
Route::get('/examupdate/{examid}/{formid}/{subjectid}','ExamResultsController@adminUpdate')->name('adminUpdate');

Route::get('/gradesheetView/{id}','ReportController@gradesheet')->name('gradesheetView');

// exam report routes
Route::get('/form/{id}/reports','ReportController@examReport')->name('examReport');
Route::post('/academics/reports','ReportController@academicReport')->name('academicReport');


// texting sms system
Route::post('/sms','MessageController@smsMessages')->name('smsMessages');


// grading scale creation and edit

Route::get('/{id}/grading','GradeController@index')->name('gradingScale');
Route::post('/{id}/grade/store','GradeController@store')->name('storeGrade');

Route::group(['middleware'=>'auth','role'=>['teacher','administrator','school-administrator','superadministrator','ict-admin']],function(){
    Route::get('/{id}/Reports','ReportController@index')->name('schoolReports');
});

//routes for academic years
Route::group(['middleware'=>'auth','role'=>['administrator','school-administrator','superadministrator']],function()
{
    Route::get('/acyear/{id}','AcademicyearController@index')->name('academicyears');
    Route::get('/acyear/{id}/add','AcademicyearController@create')->name('add_academicyear');
    Route::get('/acyear/{id}/edit','AcademicyearController@edit')->name('edit_academicyear');
    Route::post('/acyear/store','AcademicyearController@store')->name('save_acyear');
    Route::post('/acyear/{id}/update','AcademicyearController@update')->name('update_acyear');
    Route::get('/acyearterms','AcademicyearController@acyearTerms')->name('acyearterms');
});
