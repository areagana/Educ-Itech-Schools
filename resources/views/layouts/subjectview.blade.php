@Extends('layouts.users')
@section('crumbs')
    {{Breadcrumbs::render('subject',$subject,Auth::user()->school,Auth::user()->school->id)}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col-md-3 p-2 mt-2">
                <ul class="nav subject-view" style="display:block">
                    <li class="list-group-item bg-primary">
                        <a href="{{route('subject',$subject->id)}}" class="nav-link text-white h4">{{$subject->subject_name}}</a>
                    </li>
                    <li class="{{(request()->routeIs('subject') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subject',$subject->id)}}" class="nav-link">Home</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectNotes') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subjectNotes',$subject->id)}}" class="nav-link">Notes</a>
                    </li>
                    @if(Auth::user()->hasRole(['teacher']))
                        <li class="{{(request()->routeIs('subjectSchemes') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                            <a href="{{route('subjectSchemes',$subject->id)}}" class="nav-link">Schemes</a>
                        </li>
                    @endif
                    <li class="{{(request()->routeIs('assignments') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('assignments',$subject->id)}}" class="nav-link">Assignments</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectGrades') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subjectGrades',$subject->id)}}" class="nav-link">Grades</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectConferences') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subjectConferences',$subject->id)}}" class="nav-link">Conferences</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectAssessments') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subjectAssessments',$subject->id)}}" class="nav-link">Assessments</a>
                     </li>
                    <li class="{{(request()->routeIs('subjectAnnouncements') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subjectAnnouncements',$subject->id)}}" class="nav-link">Announcements</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectMember') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subjectMember',$subject->id)}}" class="nav-link">Members</a>
                    </li>
                    <!--<li class="{{(request()->routeIs('subjectFiles') ? 'list-group-item current' : 'list-group-item')}}">
                        <a href="{{route('subjectFiles',$subject->id)}}" class="nav-link">Files</a>
                    </li>-->
                </ul>
            </div>
            <div class="col-md-9 mt-2">
                @yield('subjectContent')
            </div>
        </div>
    </div>
@endsection