@Extends('layouts.app')
@section('crumbs')
    {{Breadcrumbs::render('schoolView',$school,$school->id)}}
@endsection
@section('content')
<div class="container-fluid">
    <div class="row p-2">
        <div class="col p-2">
            <h3 class="header p-2">{{$school->school_name}}
                <span class="right p-2 top-icons">
                    <a href="{{route('schoolCourses',$school->id)}}" class="{{ (request()->route('schoolCourses',$school->id)) ? 'active' : 'bg-danger' }}"><i class="fa fa-book"></i> Courses</a>
                    <a href="{{route('schoolSubjects',$school->id)}}" class="nav-link"><i class="fa fa-book"></i> Subjects</a>
                    <a href="{{route('schoolForms',$school->id)}}" class="nav-link"><i class="fa fa-book"></i> Classes</a>
                    <a href="{{route('schoolUsers',$school->id)}}" class="nav-link"><i class="fa fa-book"></i> Users</a>
                </span>
            </h3>
        </div>
    </div>
    @yield('details')
</div>
@endsection