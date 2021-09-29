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