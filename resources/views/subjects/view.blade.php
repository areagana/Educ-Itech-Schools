@Extends('layouts.users')
@section('crumbs')
    {{Breadcrumbs::render('subject',$subject,Auth::user()->school,Auth::user()->school->id)}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col-md-2 p-2">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="{{route('subject',$subject->id)}}" class="nav-link">Home</a>
                        <a href="" class="nav-link">Notes</a>
                        <a href="" class="nav-link">Assignments</a>
                        <a href="" class="nav-link">Grades</a>
                        <a href="" class="nav-link">Conferences</a>
                        <a href="" class="nav-link">Announcements</a>
                        <a href="" class="nav-link">Members</a>
                        <a href="" class="nav-link">Files</a>
                        <a href="" class="nav-link">Home</a>
                        <a href="" class="nav-link">Home</a>
                        <a href="" class="nav-link">Home</a>
                        <a href="" class="nav-link">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection