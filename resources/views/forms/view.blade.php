@Extends('layouts.schoolHome')
@section('crumbs')

@endsection
@section('schoolContent')
    <div class="row p-2">
        <div class="col p-2 m-2 bg-white">
            Form: {{$form->form_name}} <br>
            Code: {{$form->form_code}} <br>
            School: {{$school->school_name}} <br>
        </div>
        <div class="col p-2 bg-white m-2">
            Students: {{$form->users->count()}} <br>
            Teachers:  {{$form->users->count()}} <br>
            Subjects:  {{$form->subjects->count()}} <br>
        </div>
    </div>
    <div class="row p-2 ">
        <div class="col p-3 bg-white m-2">
            <h4>Assignments</h4>
            Given: {{$form->assignments->count()}} <br>
            Submitted: 
        </div>
        <div class="col p-3 bg-white m-2">
            <h4>Notes</h4>
            Given: {{$form->assignments->count()}} <br>
            Submitted: 
        </div>
        <div class="col p-3 bg-white m-2">
            <h4>Schemes</h4>
            Given: {{$form->assignments->count()}} <br>
            Submitted: 
        </div>
    </div>
    <div class="row p-2 ">
        <div class="col p-3 bg-white m-2">
            <h4>Exams</h4>
            Given: {{$form->assignments->count()}} <br>
            Submitted: 
        </div>
        <div class="col p-3 bg-white m-2">
            <h4>Time Tables</h4>
            Given: {{$form->timetables->count()}} <br>
            Submitted: 
        </div>
        <div class="col p-3 bg-white m-2">
            <h4>Conferences</h4>
            Given: {{$form->conferences->count()}} <br>
            Submitted: 
        </div>
    </div>
    <div class="row p-2 ">
        <div class="col p-3 bg-white m-2">
            <h4>Notices</h4>
            Given: {{$form->assignments->count()}} <br>
            Submitted: 
        </div>
        <div class="col p-3 bg-white m-2">
            <h4>Notes</h4>
            Given: {{$form->assignments->count()}} <br>
            Submitted: 
        </div>
        <div class="col p-3 bg-white m-2">
            <h4>Schemes</h4>
            Given: {{$form->assignments->count()}} <br>
            Submitted: 
        </div>
@endsection