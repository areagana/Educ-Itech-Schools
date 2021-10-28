@Extends('layouts.app')
@section('crumbs')
    {{Breadcrumbs::render('schools')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2">
                <h3 class="header p-3">LIST OF SCHOOLS
                    <span class="right h6">
                        <a href="{{route('newSchool')}}" class="nav-link btn btn-secondary btn-sm" @popper(Add School)><i class="fa fa-plus"></i> SCHOOL</a>
                    </span>
                </h3>
            </div>
        </div>
        <div class="row p-2">
            <div class="col p-2 inline-block">
                    @foreach($schools as $school)
                        <a href="{{route('schoolView',$school->id)}}" class="nav-link">
                            <div class="school-card p-2 shadow-sm bg-white mx-2">
                                <h5 class='p-1 text-dark'><i class="fa fa-school"></i> {{$school->school_name}}</h5>
                                <div class="p-0 border-top">
                                    <a href="#" class="nav-link"><i class="fa fa-users"> Accounts: ({{$school->users->count()}})</i></a>
                                    <a href="#" class="nav-link"><i class="fa fa-book"> Courses: ({{$school->courses->count('course_name')}})</i></a>
                                    <a href="#" class="nav-link"><i class="fa fa-user"> Students:</i></a>
                                    <a href="#" class="nav-link"><i class="fa fa-users"> Subjects: ({{$school->subjects->count()}})</i></a>
                                    <a href="#" class="nav-link"><i class="fa fa-users"> Cls ({{$school->forms->count('form_name')}})</i></a>
                                    <a href="#" class="nav-link"><i class="fa fa-users"> Cls ({{$school->forms->count('form_name')}})</i></a>
                                </div>
                                <div class="p-2 border-top">
                                    Created: {{date('M/y')}}
                                    <span class="right"><i class="fa fa-ellipsis-v btn btn-sm btn-circle btn-light" @popper(More) onclick="ShowMore('school_more{{$school->id}}')"></i>
                                    </span>
                                    <div class="more absolute more-for-schools" id="school_more{{$school->id}}">
                                            <a href="{{route('schoolEdit',$school->id)}}" class="nav-link"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="" class="nav-link"><i class="fa fa-trash"></i> Delete</a>
                                        </div>
                                        
                                </div>
                            </div>
                        </a>
                    @endforeach
            </div>
        </div>
    </div>
@endsection