@Extends('schools.details')
@section('details')
<div class="row p-2 bg-white">
        <div class="col p-2 school-courses">
            <div class="h3 header">Courses ({{count($school->courses)}})
                <span class="right h5">
                    <input type="text" class="custom-input hidden p-2 bg-light course-search" id='searchme' onkeyup="SearchItem('searchme','all-courses','.school-courses')" placeholder='Search...' autocomplete='off'>
                    <i class="fa fa-search mx-2" data-toggle='tooltip' title='Add course' onclick="ShowDiv('course-search')"></i>
                    <i class="fa fa-plus mx-2" onclick="ShowMore('more-courses')"></i>
                    <div class="more absolute bg-white p-2" id='more-courses'>
                        <a href="#" onclick="ShowDiv('new-school-course')" class="nav-link"><i class="fa fa-plus-circle"></i> Add Course</a>
                        <a href="#" class="nav-link"><i class="fa fa-plus-circle" ></i> Add Subject</a>
                    </div>
                </span>
            </div>
            <div class="p-1 school-details" id='all-courses'>
                @foreach($school->courses as $course)
                <div class="form-group school-courses" >
                    <input type="radio" name='school_course' id="course{{$course->id}}" class='school_course_subjects' value="{{$course->id}}" school_course="{{$course->id}}">
                    <label for="course{{$course->id}}">{{$course->course_name}}</label>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-9 p-2 border-left">
            @if($term)
                @if(Auth::user()->isAbleTo('subject-create'))
                    <div class="h3 header">Subjects <span class="right course-subjects"></span><span class="right"><a href="#" class="btn btn-circle btn-primary shadow" onclick="ShowMore('new-subjects')"><i class="fa fa-plus"></i></a></span></div>
                @endif
            @else
                <div class="alert alert-info p-4 h4">
                    No subject can be created if no term is set. <br>
                    Check with admin to have the term set first.
                </div>
            @endif
        <!-- select courses for the subjects addition-->
            <div class="p-2 hidden absolute bg-white shadow new-subjects" id='new-subjects'>
                <form action="{{route('SubjectsCreate')}}" method='get' id="course-subjects-add">
                    @csrf
                    <div class="h4 header">SELECT COURSE</div>
                    <div class="form-group">
                        <select name="course_id" id="course_id" class="custom-input">
                            <option value="" hidden>Select</option>
                            @foreach($school->courses as $course)
                                <option value="{{$course->id}}">{{$course->course_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="row p-2">
                    <div class="col p-2">
                        <button class="btn btn-danger btn-sm" onclick="Close('new-subjects')">Cancel</button>
                        <button class="btn btn-primary btn-sm right" type='submit' form='course-subjects-add'>Continue</button>
                    </div>
                </div>
            </div>
            <div class="p-1 school-course-subjects">
                <table class="table table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Subject Id</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Form</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody class='school-course-subject-table'>
                        @foreach($school->subjects as $subject)
                            <tr>
                                <td>{{$subject->id}}</td>
                                <td>{{$subject->subject_code}}</td>
                                <td>{{$subject->subject_name}}</td>
                                <td>{{$subject->form['form_code']}}</td>
                                <td>
                                    <i class='fa fa-plus btn btn-light btn-sm' onclick="addSubjectUser({{$subject->id}})" id="{{$subject->id}}"></i>
                                    <i class='fa fa-edit btn btn-light btn-sm' onclick='' id="{{$subject->id}}"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

            <div class=" p-1 hidden new-school-course col shadow bg-white">
                <h3 class="header p-2">NEW COURSES</h3>
                <form action="{{route('SchoolCourseStore')}}" method='POST' id='new-course-form'>
                    @csrf
                    <div class="p-1 new-course-list">
                        <div class="form-group border-bottom">
                            <input type="hidden" name='school_id' id='new_course_school_id' value="{{$school->id}}">
                            <input type="hidden" name='school_codes' id='school_code'>
                            <label for="course_code" class="form-label">
                                Course Code
                                <input type="text" class="custom-input code" id="course_code" name='course_code[]' value="{{$school->school_code}}" width="50px" required>
                            </label>
                            <label for="course_name" class="form-label">
                                Course Name
                                <input type="text" class="custom-input" id="course_name" name='course_name[]' required>
                            </label>
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col">
                            <i class="fa fa-plus btn btn-primary btn-sm btn-circle shadow right" id='new-div' title='Add course'></i>
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
    @endsection