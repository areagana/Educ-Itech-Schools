@Extends('layouts.app')
@section('crumbs')
    {{Breadcrumbs::render('schoolView',$school,$school->id)}}
@endsection
@section('content')
<div class="container-fluid">
    
    <div class="p-2 bg-white border-left right more-functions">
        <a href="" class="nav-link">Add new Students</a>
        <a href="{{route('schoolStudents',$school->id)}}" class="nav-link">School Students</a>
        <a href="" class="nav-link">Add Teachers</a>
        <a href="" class="nav-link">Enroll in Subject</a>
        <a href="" class="nav-link">Student Information</a>
        <a href="" class="nav-link">Teacher Information</a>
        <a href="{{route('schoolCourses',$school->id)}}" class="nav-link">School Courses</a>
        <a href="{{route('schoolUsers',$school->id)}}" class="nav-link">School Users</a>
        <a href="" class="nav-link">School Terms</a>
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