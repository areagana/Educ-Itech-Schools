@Extends('layouts.schoolHome')
@section('crumbs')
    {{Breadcrumbs::render('schoolView',$school,$school->id)}}
@endsection
@section('schoolContent')
<!-- school term name-->
@if($term !='')
    {{$term->term_name}}
@endif
<!-- term notification-->
<div class="term-notice shadow bg-white p-2 justify-content-center row absolute">
    <div class="col p-2 notice-info">
        <h4 class="header"><i><b>Notice</b></i></h4>
        @if($term =='')
            <span>
                No term has been set for your school. Please contact the school administrator to have a school term setup. <br>
                Thank You.
            </span>
        @endif
    </div>
    <div class="col-md-2 p-2 border-left">
        <button class="btn btn-light btn-sm right" onclick="Close('term-notice')" @popper(Close)>&times;</button>
    </div>
</div>
<!--end term notification-->
<div class="container-fluid">
    <div class="p-2 bg-white border-left right more-functions ml-2">
        <a href="" class="nav-link">Add new Students</a>
        <a href="{{route('schoolStudents',$school->id)}}" class="nav-link">School Students</a>
        <a href="{{route('SchoolTeachers',$school->id)}}" class="nav-link">Teachers</a>
        <a href="" class="nav-link">Enroll in Subject</a>
        <a href="" class="nav-link">Student Information</a>
        <a href="" class="nav-link">Teacher Information</a>
        <a href="{{route('schoolCourses',$school->id)}}" class="nav-link">School Courses</a>
        <a href="{{route('schoolUsers',$school->id)}}" class="nav-link">School Users</a>
        <a href="{{route('schoolTerms',$school->id)}}" class="nav-link">School Terms</a>
        <a href="{{route('schoolForms',$school->id)}}" class="nav-link">School Forms</a>
        <a href="{{route('schoolSubjects',$school->id)}}" class="nav-link">School Subjects</a>
    </div>
    <div class="row p-2">
        <div class="col p-2">
            <h3 class="header p-2">{{$school->school_name}}</h3>
        </div>
    </div>
    @yield('details')
</div>
@endsection