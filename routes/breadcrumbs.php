<?php

//Home Routes
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
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
