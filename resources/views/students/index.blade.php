@Extends('schools.details')
@section('details')
    <div class="container-fluid student-page">
        <div class="row p-2 bg-white">
            <div class="col p-2">
                <div class="card p-2 border border-primary">
                    <h5 class="header"><b>FILTER STUDENTS BY CLASS</b>
                        <span class="right">
                            <input type="text" class="form-control form-control-sm" id='student-search' placeholder="Search student...">
                        </span>
                    </h5>
                    <span class="inline-block">
                        <b>Class Code:</b>
                        @foreach($school->forms as $form)
                            <a  class="nav-link class-filter" onclick="LocateStudents({{$school->id}},{{$form->id}},$(this).text())">{{$form->form_name}}</a>
                        @endforeach
                            <a  class="nav-link class-filter" onclick="LocateStudents({{$school->id}},{{__('100')}},$(this).text())">Graduates</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="row p-2 bg-white mt-2">
            <div class="col p-2">
                <div class="card border border-primary p-2">
                    <div class="form-student-title border-bottom border-primary h4 hidden"></div>
                    <table class="table table-sm data-table">
                        <thead class="table-info" id='student-table-thead'>
                            <tr>
                                <th colspan='2'>
                                    <select name="" id="" class="custom-select custom-select-sm" onchange="LocateStudents({{$school->id}},$(this).val(),'')">
                                        <option value="" hidden>All</option>
                                        @foreach($school->forms as $form)
                                            <option value="{{$form->id}}">{{$form->form_name}}</option>
                                        @endforeach
                                        <option value="100">Graduates</option>
                                    </select>
                                </th>
                                <th colspan='4'>
                                    <input type="text" class="form-control form-control-sm" id="searchStudent" onkeyup="SearchItem('searchStudent','school-students','tr')" placeholder=' Search...'>
                                </th>
                            </tr>
                            <tr id='students-table-thead-tr'>
                                <th>
                                    <input type="checkbox" name="school_student[]" id="check_all" onclick="toggle(this)"> All
                                </th>
                                <th>User Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                @if(Auth::user()->isAbleTo(['users-edit','users-delete','users-update']))
                                <th>More</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="school-students">
                            @foreach($students as $student)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="school_student" id="{{$school->school_code}}{{$student->id}}" value="{{$student->id}}" class='form-check'>
                                    </td>
                                    <td>{{$student->id}}</td>
                                    <td>{{$student->firstName}}, {{$student->lastName}}</td>
                                    <td>{{$student->email}}</td>
                                    <td>
                                        @if($student->hasRole('student'))
                                        {{__('Student')}}
                                        @endif
                                    </td>
                                    @if(Auth::user()->isAbleTo(['users-edit','users-delete','users-update']))
                                    <td>
                                        <div class="span inline-block">
                                            <a href="{{route('userEdit',$student->id)}}" class="nav-link btn btn-circle btn-sm btn-white"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="nav-link btn btn-circle btn-sm btn-white" onclick="xdialog.confirm('Confirm to delete this user?',function(){deleteItem({{$student->id}},'/user/delete/{{$student->id}}')})"><i class="fa fa-trash"></i></a>
                                            <a href="#" class="nav-link btn btn-sm btn-white btn-circle right"><i class="fa fa-ellipsis-v"></i></a>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row p-0 bg-light mx-1">
                        <div class="col p-2">
                            <select name="functions" id="functions" class="custom-select custom-select-sm" onchange="checkSection($(this).val(),'school_student')">
                                <option value="">Select Function</option>
                                <option value="Subject-enroll-users">Mass Enroll</option>
                                <option value="Promote-to-Class">Promote To new class</option>
                                <option value="un-enroll">Un Enroll From Subject</option>
                            </select>
                        </div>
                        <div class="col p-2 hidden class-subjects">
                            <select name="class_subjects" id="class_subjects" class="custom-select custom-select-sm">
                                <option value="">Select subject</option>
                            </select>
                        </div>
                        <div class="col p-2 hidden school-classes">
                            <select name="school-classes" id="school-classes" class="custom-select custom-select-sm">
                                <option value="">Select class</option>
                                @foreach($school->forms as $form)
                                    <option value="{{$form->id}}">{{$form->form_name}}</option>
                                @endforeach
                                    <option value='100'>Graduates</option>
                            </select>
                        </div>
                        <div class="col p-2">
                            <button class="btn btn-primary btn-sm right" onclick = "studentFunctions('school_student')">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            {{$students->links()}}
        </div>
    </div>
@endsection