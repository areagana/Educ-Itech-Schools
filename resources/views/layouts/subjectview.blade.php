@Extends('layouts.users')
@section('crumbs')
    {{Breadcrumbs::render('subject',$subject,Auth::user()->school,Auth::user()->school->id)}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row mx-0">
            <div class="col-md-2 p-0 mt-1">
                <ul class="nav subject-view" style="display:block">
                    <li class="list-group-item bg-primary">
                        <a href="{{route('card',$subject->id)}}" class="nav-link text-white h6">{{$card->form->form_name}} {{$subject->subject_name}}</a>
                    </li>
                    <li class="{{(request()->routeIs('subject') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('card',$subject->id)}}" class="nav-link">Home</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectNotes') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subjectNotes',$subject->id)}}" class="nav-link">Notes</a>
                    </li>
                    @if(Auth::user()->hasRole(['teacher']))
                        <li class="{{(request()->routeIs('subjectSchemes') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                            <a href="{{route('subjectSchemes',$card->id)}}" class="nav-link">Schemes</a>
                        </li>
                    @endif
                    <li class="{{(request()->routeIs('subjectMember') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subjectMember',$card->id)}}" class="nav-link">Class List</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectAssessments') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subjectAssessments',$card->id)}}" class="nav-link">Mark Update</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectTopics') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subjectTopics',$card->id)}}" class="nav-link">Topics</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectCoursework') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subjectCoursework',$card->id)}}" class="nav-link">AOI MarkList</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectGrades') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subjectGrades',$card->id)}}" class="nav-link">Grades</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectConferences') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subjectConferences',$subject->id)}}" class="nav-link">Conferences</a>
                    </li>
                    <li class="{{(request()->routeIs('assignments') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('assignments',$card->id)}}" class="nav-link">Assignments</a>
                    </li>
                    <li class="{{(request()->routeIs('subjectAnnouncements') ? 'list-group-item current p-1' : 'list-group-item p-1')}}">
                        <a href="{{route('subjectAnnouncements',$subject->id)}}" class="nav-link">Announcements</a>
                    </li>
                    
                    <!--<li class="{{(request()->routeIs('subjectFiles') ? 'list-group-item current' : 'list-group-item')}}">
                        <a href="{{route('subjectFiles',$subject->id)}}" class="nav-link">Files</a>
                    </li>-->
                </ul>
            </div>
            <div class="col mt-2">
                @yield('subjectContent')
            </div>
        </div>
    </div>
@endsection