@Extends('layouts.users')
@section('crumbs')
    {{Breadcrumbs::render('subject',$subject,Auth::user()->school,Auth::user()->school->id)}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col-md-2 p-2 bg-white mt-2 shadow-sm">
                <ul class="nav" style="display:block">
                    <li class="nav-item">
                        <a href="{{route('subject',$subject->id)}}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('subjectNotes',$subject->id)}}" class="nav-link">Notes</a>
                    </li>
                    @if(Auth::user()->hasRole(['teacher']))
                        <li class="nav-item">
                            <a href="{{route('subjectSchemes',$subject->id)}}" class="nav-link">Schemes</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{route('assignments',$subject->id)}}" class="nav-link">Assignments</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('subjectGrades',$subject->id)}}" class="nav-link">Grades</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('subjectConferences',$subject->id)}}" class="nav-link">Conferences</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('subjectAssessments',$subject->id)}}" class="nav-link">Assessments</a>
                     </li>
                    <li class="nav-item">
                        <a href="{{route('subjectAnnouncements',$subject->id)}}" class="nav-link">Announcements</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('subjectMember',$subject->id)}}" class="nav-link">Members</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('subjectFiles',$subject->id)}}" class="nav-link">Files</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 mt-2">
                @yield('subjectContent')
            </div>
        </div>
    </div>
@endsection