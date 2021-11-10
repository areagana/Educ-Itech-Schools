@Extends('schools.details')
@section('crumbs')
    {{Breadcrumbs::render('schoolView',$school,$school->id)}}
@endsection
@section('details')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2">
                <a href="" class="nav-link">Dashbboard</a>
            </div>
        </div>
        <div class="row p-2">
            <div class="col p-3 bg-white shadow-sm dash-card mx-1">
                <h4>Courses</h4>
                <div class="row p-2">
                    <div class="col p-2">
                        <img src="{{asset('course.jpg')}}" alt="" class='img-sm img-sm rounded-circle'>
                    </div>
                    <div class="col p-2 border-left">
                        <span class="p-4 h3">
                        {{$school->courses->count()}}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col p-3 bg-white shadow-sm dash-card mx-1">
                <h4>Subjects</h4>
                <div class="row p-2">
                    <div class="col p-2">
                        <img src="{{asset('subject-icon.png')}}" alt="" class='img-sm img-sm rounded-circle'>
                    </div>
                    <div class="col p-2 border-left">
                        <span class="p-4 h3">
                        {{$term->subjects->count()}}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col p-3 bg-white shadow-sm dash-card mx-1">
                <h4>Users</h4>
                <div class="row p-2">
                    <div class="col p-2">
                        <img src="{{asset('student icon.png')}}" alt="" class='img-sm img-sm rounded-circle'>
                    </div>
                    <div class="col p-2 border-left">
                        <span class="p-4 h3">
                        {{$school->users->count()}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col p-3 bg-white shadow-sm dash-card mx-1">
                <h4>Exams</h4>
                <div class="row p-2">
                    <div class="col p-2">
                        <img src="{{asset('exams-icon.png')}}" alt="" class='img-sm rounded-circle'>
                    </div>
                    <div class="col p-2 border-left">
                        <span class="p-4 h3">
                        {{$term->exams->count()}}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col p-3 bg-white shadow-sm dash-card mx-1">
                <h4>Assignments</h4>
                <div class="row p-2">
                    <div class="col p-2">
                        <img src="{{asset('assignment-icon.png')}}" alt="" class='img-sm rounded-circle'>
                    </div>
                    <div class="col p-2 border-left">
                        <span class="p-4 h3">
                        {{$term->assignments->count()}}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col p-3 bg-white shadow-sm dash-card mx-1">
                <h4>Notices</h4>
                <div class="row p-2">
                    <div class="col p-2">
                        <img src="{{asset('notice-icon.jpg')}}" alt="" class='img-sm rounded-circle'>
                    </div>
                    <div class="col p-2 border-left">
                        <span class="p-4 h3">
                        {{$school->announcements->count()}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col p-3 bg-white shadow-sm dash-card mx-1">
                <h4>Exams</h4>
                <div class="row p-2">
                    <div class="col p-2">
                        <img src="{{asset('exams-icon.png')}}" alt="" class='img-sm rounded-circle'>
                    </div>
                    <div class="col p-2 border-left">
                        <span class="p-4 h3">
                        {{$term->exams->count()}}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col p-3 bg-white shadow-sm dash-card mx-1">
                <h4>Assignments</h4>
                <div class="row p-2">
                    <div class="col p-2">
                        <img src="{{asset('assignment-icon.png')}}" alt="" class='img-sm rounded-circle'>
                    </div>
                    <div class="col p-2 border-left">
                        <span class="p-4 h3">
                        {{$term->assignments->count()}}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col p-3 bg-white shadow-sm dash-card mx-1">
                <h4>Notices</h4>
                <div class="row p-2">
                    <div class="col p-2">
                        <img src="{{asset('notice-icon.jpg')}}" alt="" class='img-sm rounded-circle'>
                    </div>
                    <div class="col p-2 border-left">
                        <span class="p-4 h3">
                        {{$school->announcements->count()}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection