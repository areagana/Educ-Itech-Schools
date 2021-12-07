@Extends('layouts.users')
@section('crumbs')
    {{Breadcrumbs::render('subject',$subject,Auth::user()->school,Auth::user()->school->id)}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col-md-2 p-2 bg-white mt-2 shadow-sm">
                <ul class="nav subject-view" style="display:block">
                    <li class="{{(request()->routeIs('subject') ? 'current' : '')}}">
                        <a href="{{route('subject',$subject->id)}}" class="nav-link">Home</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectNotes') ? 'current' : '')}}">
                        <a href="{{route('subjectNotes',$subject->id)}}" class="nav-link">Notes</a>
                    </li>
                    @if(Auth::user()->hasRole(['teacher']))
                        <li class="{{(request()->routeIs('subjectSchemes') ? 'current' : '')}}">
                            <a href="{{route('subjectSchemes',$subject->id)}}" class="nav-link">Schemes</a>
                        </li>
                    @endif
                    <li class="{{(request()->routeIs('assignments') ? 'current' : '')}}">
                        <a href="{{route('assignments',$subject->id)}}" class="nav-link">Assignments</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectGrades') ? 'current' : '')}}">
                        <a href="{{route('subjectGrades',$subject->id)}}" class="nav-link">Grades</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectConferences') ? 'current' : '')}}">
                        <a href="{{route('subjectConferences',$subject->id)}}" class="nav-link">Conferences</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectAssessments') ? 'current' : '')}}">
                        <a href="{{route('subjectAssessments',$subject->id)}}" class="nav-link">Assessments</a>
                     </li>
                    <li class="{{(request()->routeIs('subjectAnnouncements') ? 'current' : '')}}">
                        <a href="{{route('subjectAnnouncements',$subject->id)}}" class="nav-link">Announcements</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectMember') ? 'current' : '')}}">
                        <a href="{{route('subjectMember',$subject->id)}}" class="nav-link">Members</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectFiles') ? 'current' : '')}}">
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