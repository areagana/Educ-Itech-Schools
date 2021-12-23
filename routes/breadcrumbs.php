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

Breadcrumbs::for('newSchool', function ($trail) {
    $trail->parent('schools');
    $trail->push('New School', route('newSchool'));
});

Breadcrumbs::for('schoolEdit', function ($trail,$school,$id) {
    $trail->parent('schools');
    $trail->push($school->school_name, route('schoolEdit',$id));
});

Breadcrumbs::for('schoolView', function ($trail,$school,$id) {
    $trail->parent('schools');
    $trail->push($school->school_name, route('schoolView',$id));
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
    $trail->parent('subject',$subject,$subject->course->school,$subject->course->school->id);
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
    $trail->parent('subject',$subject,$subject->course->school,$subject->course->school->id);
    $trail->push('Members',route('subjectMember',$id));
});
Breadcrumbs::for('subjectConferences',function($trail,$subject,$id){
    $trail->parent('subject',$subject,$subject->course->school,$subject->course->school->id);
    $trail->push('Conferences',route('subjectConferences',$id));
});
Breadcrumbs::for('subjectNotes',function($trail,$subject,$id){
    $trail->parent('subject',$subject,$subject->course->school,$subject->course->school->id);
    $trail->push('Modules',route('subjectNotes',$id));
});
Breadcrumbs::for('subjectFiles',function($trail,$subject,$id){
    $trail->parent('subject',$subject,$subject->course->school,$subject->course->school->id);
    $trail->push('Files',route('subjectFiles',$id));
});
Breadcrumbs::for('subjectAnnouncements',function($trail,$subject,$id){
    $trail->parent('subject',$subject,$subject->course->school,$subject->course->school->id);
    $trail->push('Annoucements',route('subjectAnnoucements',$id));
});
Breadcrumbs::for('assignment.show',function($trail,$subject,$assignment,$id,$id2){
    $trail->parent('assignments',$subject,$subject->course->school,$subject->course->school->id);
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