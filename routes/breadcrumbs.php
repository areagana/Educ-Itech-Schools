<?php

//Home Routes
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Dashboard', route('home'));
});

//schools scrumbs
Breadcrumbs::for('schools', function ($trail) {
    $trail->parent('home');
    $trail->push('Schools', route('schools'));
});

Breadcrumbs::for('addSchool', function ($trail) {
    $trail->parent('schools');
    $trail->push('New School', route('addSchool'));
});

Breadcrumbs::for('schoolHome', function ($trail,$school) {
    $trail->push("Home", route('schoolView',$school->id));
});

Breadcrumbs::for('schoolView', function ($trail,$school) {
    $trail->parent('schools');
    $trail->push($school->school_name, route('schoolView',$school->id));
});

Breadcrumbs::for('schoolEdit', function ($trail,$school) {
    $trail->parent('schools');
    $trail->push($school->school_name, route('schoolEdit',$school->id));
});

Breadcrumbs::for('schoolProfile', function ($trail,$school) {
    $trail->parent('schoolHome',$school);
    $trail->push("Profile", route('schoolProfile',$school->id));
});



Breadcrumbs::for('users', function ($trail,$school) {
    $trail->parent('schoolHome',$school);
    $trail->push("Users", route('schoolUsers',$school->id));
});

Breadcrumbs::for('Profile', function ($trail) {
    $trail->parent('home');
    $trail->push("Profile", route('profile'));
});




/**subjects
 * subjects crumbs
 */
Breadcrumbs::for('subjects', function ($trail,$course,$school,$id) {
    $trail->parent('schoolView',$school,$id);
    $trail->push($course->course_name, route('schools'));
});
Breadcrumbs::for('school', function ($trail,$school,$id) {
    $trail->push($school->school_name, route('school',$id));
});
Breadcrumbs::for('subject', function ($trail,$subject,$school,$id) {
    $trail->push($subject->subject_name, route('subject',$subject->id));
});

Breadcrumbs::for('userSubjects',function($trail){
    $trail->push('Subjects',route('userSubjects'));
});
/**
 * grades crumbs
 */
Breadcrumbs::for('subjectGrades',function($trail,$subject,$id){
    $trail->parent('subject',$subject,$subject->school,$subject->school->id);
    $trail->push('Grade Book',route('subjectGrades',$id));
});

/**
 *assignments
 */
Breadcrumbs::for('assignments',function($trail,$subject,$id){
    $trail->parent('subject',$subject,$subject->school,$id);
    $trail->push('Assignments',route('assignments',$subject->id));
});
Breadcrumbs::for('CreateAssignments',function($trail,$subject,$id){
    $trail->parent('assignments',$subject,$id);
    $trail->push('Create',route('CreateAssignments',$subject->id));
});
Breadcrumbs::for('subjectMember',function($trail,$subject,$id){
    $trail->parent('subject',$subject,$subject->school,$subject->school->id);
    $trail->push('Members',route('subjectMember',$id));
});
Breadcrumbs::for('subjectConferences',function($trail,$subject,$id){
    $trail->parent('subject',$subject,$subject->school,$subject->school->id);
    $trail->push('Conferences',route('subjectConferences',$id));
});
Breadcrumbs::for('subjectNotes',function($trail,$subject,$id){
    $trail->parent('subject',$subject,$subject->school,$subject->school->id);
    $trail->push('Modules',route('subjectNotes',$id));
});
Breadcrumbs::for('subjectFiles',function($trail,$subject,$id){
    $trail->parent('subject',$subject,$subject->school,$subject->school->id);
    $trail->push('Files',route('subjectFiles',$id));
});
Breadcrumbs::for('subjectAnnouncements',function($trail,$subject,$id){
    $trail->parent('subject',$subject,$subject->school,$subject->school->id);
    $trail->push('Annoucements',route('subjectAnnoucements',$id));
});
Breadcrumbs::for('assignment.show',function($trail,$subject,$assignment,$id,$id2){
    $trail->parent('assignments',$subject,$subject->school,$subject->school->id);
    $trail->push($assignment->assignment_name,route('assignment.show',[$id,$id2]));
});
Breadcrumbs::for('gradeAssignment',function($trail,$subject,$assignment,$id,$id2){
    $trail->parent('assignment.show',$subject,$assignment,$id,$id2);
    $trail->push('Grading',route('gradeAssignment',$id2));
});

/**
 * categoris crumbs
 */
Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('home');
    $trail->push('Category', route('categories'));
});

//MANAGE EXAM RESULTS
Breadcrumbs::for('Exams', function ($trail,$school) {
    $trail->parent('home');
    $trail->push("Assessments", route('schoolAssessments',$school->id));
});
Breadcrumbs::for('Examname', function ($trail,$exam,$school) {
    $trail->parent('Exams',$school);
    $trail->push($exam->exam_name, route('marksheet',$exam->id));
});
Breadcrumbs::for('Results', function ($trail,$exam,$school,$form,$subject) {
    $trail->parent('Examname',$exam,$school);
    $trail->push('Results', route('adminUpdate',[$exam->id,$form->id,$subject->id]));
});

// form/class view
Breadcrumbs::for('Forms', function ($trail,$school) {
    $trail->parent('home',);
    $trail->push('Classes', route('schoolForms',$school->id));
});

Breadcrumbs::for('FormView', function ($trail,$school,$form) {
    $trail->parent('Forms',$school);
    $trail->push($form->form_name, route('formView',$form->id));
});