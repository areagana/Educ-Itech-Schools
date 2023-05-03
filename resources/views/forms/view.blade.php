@Extends('layouts.schoolHome')
@section('crumbs')
    {{Breadcrumbs::render('FormView',$school,$form)}}
@endsection
@section('schoolContent')
    <div class="row mx-1">
        <div class="col p-1">
            <span class='p-1 h5'>{{$form->form_name}}</span>
        </div>
        <div class="col inline-block text-right p-1">
            <button class="btn btn-sm btn-info btn-flat"><i class="fa fa-users"></i> STUDENTS</button>
            <button class="btn btn-sm btn-primary btn-flat"><i class="fa fa-book"></i> REPORTS</button>
            <button class="btn btn-sm btn-success btn-flat"><i class="fa fa-download"></i> CSV</button>
            <button class="btn btn-sm btn-danger btn-flat"><i class="fa fa-reply"></i> PDF</button>
        </div>
    </div>
    <hr>
    <div class="row mx-1">
        <div class="col p-2">
            <div class="row p-2">
                <div class="col p-2 m-2 bg-white">
                    Form: {{$form->form_name}} <br>
                    Code: {{$form->form_code}} <br>
                    School: {{$school->school_name}} <br>
                </div>
                <div class="col p-2 bg-white m-2">
                    Students: {{$form->users()->count()}} <br>
                    Teachers:  {{$form->users()->count()}} <br>
                </div>
            </div>
            <div class="row p-2 ">
                <div class="col p-3 bg-white m-2">
                    <h4>Assignments</h4>
                    Given: {{$form->assignments()->count()}} <br>
                    Submitted: 
                </div>
                <div class="col p-3 bg-white m-2">
                    <h4>Notes</h4>
                    Given: {{$form->assignments()->count()}} <br>
                    Submitted: 
                </div>
                <div class="col p-3 bg-white m-2">
                    <h4>Schemes</h4>
                    Given: {{$form->assignments()->count()}} <br>
                    Submitted: 
                </div>
            </div>
            <div class="row p-2 ">
                <div class="col p-3 bg-white m-2">
                    <h4>Exams</h4>
                    Given: {{$form->assignments()->count()}} <br>
                    Submitted: 
                </div>
                <div class="col p-3 bg-white m-2">
                    <h4>Time Tables</h4>
                    Given: {{$form->timetables()->count()}} <br>
                    Submitted: 
                </div>
                <div class="col p-3 bg-white m-2">
                    <h4>Conferences</h4>
                    Given: {{$form->conferences()->count()}} <br>
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
            </div>
        </div>
        <div class="col-md-3 p-2 border-left">
            <div class="h4 p-2">MORE INFO</div>
            <hr>
            <div class="p-2">
                <div class="card border rounded-3">
                    <div class="card-header">
                        STREAMS
                    </div>
                    <div class="card-body">
                        @foreach($form->streams as $stream)
                            <div class="nav-link">{{$stream->name}}</div>
                        @endforeach
                    </div>
                </div>
                <div class="card border rounded-3 my-2">
                    <div class="card-header">
                        TEACHERS
                    </div>
                    <div class="card-body">

                    </div>
                </div>
                <div class="card border rounded-3 my-2">
                    <div class="card-header">
                        EXAMS
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection