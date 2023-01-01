@Extends('layouts.app')
@section('crumbs')
    {{Breadcrumbs::render('schools')}}
@endsection
@section('content')
    <div class="container-fluid bg-white shadow-sm p-2">
        <h3 class="header">SCHOOLS
            <span class="right h5">
               <a href="{{route('addSchool')}}" class="nav-link"> <i class="fa fa-plus btn btn-sm btn-circle shadow btn-secondary" title='New School'></i></a>
            </span>
        </h3>
        <div class="row">
            <div class="p-3 border border-light col school-datas">
                <div class="h6 header">School List
                    <span class="right">
                        <input type="text" class="custom-input" id="school-search" placeholder='Search...'>
                    </span>
                </div>
                @foreach($schools as $school)
                <div class="inline-flex items-center mx-6 text-sm p-2">
                    <label for="{{$school->id}}">
                        <input type="radio" class="form-checkbox h-4 w-4 school-id" id="{{$school->id}}" value="{{$school->id}}" name ='school-name' sch_name="{{$school->school_name}}">
                        <span class="ml-2">{{$school->school_name}}</span>
                    </label>
                </div>
                @endforeach
            </div>
            <div class="col p-2 school-courses hidden school-datas">
                <h5 class="header school-name"></h5>
                <div class="p-2 school-course-list school-datas" >

                </div>
            </div>
            <div class="col p-2 hidden school-datas new-school">
                <h5 class="header">New School</h5>
                <form action="{{route('schoolStore')}}" method='POST' id='new-school-form'>
                    @csrf
                    <div class="form-group">
                        <label for="school_name" class="form-label">School Name</label>
                        <input type="text" class="custom-input" name='school_name' id='school_name'>
                    </div>
                    <div class="form-group">
                        <label for="school_code" class="form-label">School Code</label>
                        <input type="text" class="custom-input" name='school_code' id='school_code'>
                    </div>
                    <div class="form-group">
                        <label for="school_reg_no" class="form-label">School Reg No</label>
                        <input type="text" class="custom-input" name='school_reg_no' id='school_reg_no'>
                    </div>
                    <div class="form-group">
                        <label for="school_address" class="form-label">School Address</label>
                        <input type="text" class="custom-input" name='school_address' id='school_address'>
                    </div>
                    <div class="form-group">
                        <label for="school_email" class="form-label">School Email</label>
                        <input type="text" class="custom-input" name='school_email' id='school_email'>
                    </div><div class="form-group">
                        <label for="school_contact" class="form-label">School Contact</label>
                        <input type="text" class="custom-input" name='school_contact' id='school_contact'>
                    </div><div class="form-group">
                        <label for="school_website" class="form-label">School Website</label>
                        <input type="text" class="custom-input" name='school_website_link' id='school_website'>
                    </div>
                </form>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-sm btn-danger" onclick="Close('new-school')">Cancel</button>
                        <button class="btn btn-sm btn-primary right" type='submit' form='new-school-form'>Submit</button>
                    </div>
                </div>
            </div>
            <div class="p-2 hidden new-school-course col school-datas">
                <form action="{{route('SchoolCourseStore')}}" method='POST' id='new-course-form'>
                    @csrf
                    <div class="p-1 new-course-list">
                        <div class="form-group">
                            <input type="hidden" name='school_id' id='new_course_school_id'>
                            <input type="hidden" name='school_codes' id='school_code'>
                            <label for="course_code" class="form-label">
                                Course Code
                                <input type="text" class="custom-input code" id="course_code" name='course_code[]' width="50px" >
                            </label>
                            <label for="course_name" class="form-label">
                                Course Name
                                <input type="text" class="custom-input" id="course_name" name='course_name[]' >
                            </label>
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col">
                            <i class="fa fa-plus btn btn-primary btn-sm btn-circle shadow right" id='new-div'></i>
                        </div>
                    </div>
                </form>
                <div class="row p-1">
                    <div class="col">
                        <button class="btn btn-danger btn-sm" onclick="Close('new-school-course')">Cancel</button>
                        <button class="btn btn-success btn-sm right" type='submit' form='new-course-form'>Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-2 mt-2">
            <div class="col p-2">
                <h4 class="header">Users</h4>
                <div class="p-2 school-users">
                    Users
                </div>
            </div>
            <div class="col p-2">
                <h4 class="header">Staff</h4>
                <div class="p-2 school-staff">
                    staff
                </div>
            </div>
        </div>
        <div class="row p-2 mt-2">
            <div class="col p-2">
                <h4 class="header">Classes (Forms)</h4>
                <div class="p-2 school-users">
                    Users
                </div>
            </div>
            <div class="col p-2">
                <h4 class="header">Staff</h4>
                <div class="p-2 school-staff">
                    staff
                </div>
            </div>
        </div>
    </div>

@endsection