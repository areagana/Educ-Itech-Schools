@Extends('layouts.users')
@section('crumbs')
    {{Breadcrumbs::render('subject',$subject,Auth::user()->school,Auth::user()->school->id)}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col-md-2 p-2 bg-white">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="{{route('subject',$subject->id)}}" class="nav-link">Home</a>
                        <a href="{{route('subjectNotes',$subject->id)}}" class="nav-link">Notes</a>
                        <a href="{{route('assignments',$subject->id)}}" class="nav-link">Assignments</a>
                        <a href="{{route('subjectGrades',$subject->id)}}" class="nav-link">Grades</a>
                        <a href="{{route('subjectConferences',$subject->id)}}" class="nav-link">Conferences</a>
                        <a href="{{route('subjectAnnouncements',$subject->id)}}" class="nav-link">Announcements</a>
                        <a href="{{route('subjectMember',$subject->id)}}" class="nav-link">Members</a>
                        <a href="{{route('subjectFiles',$subject->id)}}" class="nav-link">Files</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 p-2">
                @yield('subjectContent')
            </div>
        </div>
    </div>
@endsection