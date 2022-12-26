@Extends('schools.details')
@section('details')
    <div class="container-fluid student-page">
        <div class="row p-2 bg-white">
            <div class="col p-2">
                <div class="card p-2 border border-primary">
                    <h5 class="header"><b>FILTER STUDENTS BY CLASS</b>
                        <span class="right inline-block h6">
                            <a href="#" class="btn btn-sm btn-outline-success" data-toggle='modal' data-target='#UserFunctions'><i class="fa fa-upload"></i> Upload Students</a>
                            <!-- <a href="#" class="btn btn-sm btn-light btn-circle" data-toggle='modal' data-target='#UserFunctions'><i class="fa fa-ellipsis-v"></i></a> -->
                        </span>
                    </h5>
                    <span class="inline-block">
                        <b>Class:</b>
                        @foreach($school->forms as $form)
                            <a  class="nav-link class-filter" onclick="LocateStudents({{$school->id}},{{$form->id}},$(this).text())">{{$form->form_name}}</a>
                        @endforeach
                            <a  class="nav-link class-filter" onclick="LocateStudents({{$school->id}},{{__('100')}},$(this).text())">Graduates</a>
                            <span class="right">
                                <a href="{{route('student.create',$school->id)}}" class="btn btn-sm btn-outline-info"><i class="fa fa-plus-circle"></i> Student</a>
                            </span>
                    </span>
                </div>
            </div>
        </div>
        <div class="row p-2 bg-white mt-2">
            <div class="col p-2">
                <div class="card border border-primary p-2 table-responsive">
                    <div class="form-student-title border-bottom border-primary h4 hidden"></div>
                    <table class="table table-sm data-table ">
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
                                <th colspan='6'>
                                    <input type="text" class="form-control form-control-sm" id="searchStudent" onkeyup="SearchItem('searchStudent','school-students','tr')" placeholder=' Search...'>
                                </th>
                            </tr>
                            <tr id='students-table-thead-tr'>
                                <th>
                                    <input type="checkbox" name="school_student[]" id="check_all" onclick="toggle(this)" class='form-check-input mx-2'> All
                                </th>
                                <th>Admin No</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Stream</th>
                                <th>Year</th>
                                <th>Email</th>
                                @if(Auth::user()->isAbleTo(['users-edit','users-delete','users-update']))
                                <th>More</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="school-students">
                            @foreach($students as $student)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="school_student" id="{{$school->school_code}}{{$student->id}}" value="{{$student->id}}" class='form-check-input mx-2'>
                                    </td>
                                    <td>{{$student->admin_no}}</td>
                                    <td>{{$student->firstname}} {{$student->middlename}} {{$student->lastname}}</td>
                                    <td>{{$student->form->form_name}}</td>
                                    <td>{{($student->stream) ? $student->stream->name : ''}}</td>
                                    <td>{{$student->year}}</td>
                                    <td>{{$student->email}}</td>
                                    @if(Auth::user()->isAbleTo(['users-edit','users-delete','users-update']))
                                    <td>
                                        <div class="span inline-block">
                                            <a href="{{route('studentEdit',$student->id)}}" class="nav-link btn btn-circle btn-sm btn-white"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="nav-link btn btn-circle btn-sm btn-white" onclick="xdialog.confirm('Confirm to delete this student?',function(){deleteItem({{$student->id}},'/student/delete/{{$student->id}}')})"><i class="fa fa-trash"></i></a>
                                            <a href="#" class="btn btn-sm btn-light btn-circle right"><i class="fa fa-ellipsis-v"></i></a>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="row p-0 bg-light mx-1 border-top border-primary mt-1">
                        <div class="col p-2">
                            <select name="functions" id="functions" class="custom-select custom-select-sm" onchange="checkSection($(this).val(),'school_student')">
                                <option value="">Select Function</option>
                                <option value="Subject-enroll-users">Mass Enroll (Subject)</option>
                                <option value="Promote-to-Class">Promote To new class</option>
                                <option value="un-enroll">Un Enroll From Subject</option>
                            </select>
                        </div>
                        <div class="col p-2 hidden class-subjects">
                            <select name="class_subjects" id="class_subjects" class="custom-select custom-select-sm">
                                <option value="">Select subject</option>
                                @foreach($school->subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="col p-2 hidden school-classes">
                            <select name="school-classes" id="school-classes" class="custom-select custom-select-sm">
                                <option value="">Select class</option>
                                @foreach($school->forms as $form)
                                    <option value="{{$form->id}}">{{$form->form_name}}</option>
                                @endforeach
                                <option value="100">Graduate</option>
                            </select>
                        </div>
                        <div class="col p-2 hidden form-streams">
                            <select name="form-streams" id="form-streams" class="custom-select custom-select-sm ">
                                <option value="">Select strean</option>
                                @foreach($form->streams as $stream)
                                    <option value="{{$stream->id}}">{{$stream->name}}</option>
                                @endforeach
                                    <option value='100'>Graduates</option>
                            </select>
                        </div>
                        <div class="col p-2 hidden academic_year">
                            <input type="text" name="academic_year" id="academic_year" class="form-control form-control-sm" placeholder='year..'>
                            <input type="hidden" name="school_term" id='school_term' value="{{$term->id}}">
                        </div>
                        <div class="col p-2">
                            <button class="btn btn-primary btn-sm right" onclick = "studentFunctions('school_student')">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id='UserFunctions' data-backdrop='static' tabindex="-1" role="dialog" aria-labelledby="UserFunctions" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">STUDENTS DATA PROFILE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mx-2">
                    <div class="col p-2">
                        <form action="{{route('StudentTemplate',$school->id)}}" method='POST'>
                            @csrf
                            <div class="input-group">
                                <select name="form_id" id="form_id" class="form-control" required>
                                    <option value="">Select Class</option>
                                    @foreach($school->forms as $form)
                                        <option value="{{$form->id}}">{{$form->form_name}}</option>
                                    @endforeach
                                </select>
                                <button type='submit' class="btn btn-outline-info shadow-sm"><i class="fa fa-download"></i> Download Students Template</button>
                            </div>
                        </form>
                    </div>
                    <div class="col p-2">
                        <a href="#" class="nav-link btn btn-outline-danger shadow-sm"><i class="fa fa-download"></i> Download Students Data</a>
                    </div>
                </div>
                <div class="row mx-2">
                    <div class="col p-2">
                        <p>
                            Download a csv file, enter students data according to the data arrangement displayed in the file and in the table below.
                        </p>
                    </div>
                </div>
                <div class="row mx-2">
                    <div class="col p-2">
                        <h4 class="border-bottom border-primary">KEY DATA REQUIRED</h4>
                        <p>
                            Fill file data with the information as organised by the file headers downloaded.
                        </p>
                        <p>
                            You will find a number at the end of the file name, which should be populated in the field "form_id" for every student information filled. <br>
                            Check the example in the table below for organisation of data.
                        </p>
                        <table class="table table-sm table-bordered text-center">
                            <thead>
                                <tr class='bg-success text-white'>
                                    <th>A</th>
                                    <th>B</th>
                                    <th>C</th>
                                    <th>D</th>
                                    <th>E</th>
                                    <th>F</th>
                                    <th>G</th>
                                </tr>
                                <tr class='bg-secondary text-white'>
                                    <th>Admin_no</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>lastname</th>
                                    <th>gender</th>
                                    <th>email</th>
                                    <th>form_id</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ARH/22/1029</td>
                                    <td>Ahimbisibwe</td>
                                    <td>John</td>
                                    <td>Reagan</td>
                                    <td>Male</td>
                                    <td>reagan@email.com</td>
                                    <td>23</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mx-2">
                    <div class="col p-2">
                        <p>Upload Students' data by attaching the CSV file filled. Upload the File to insert users.</p>
                    </div>
                </div>
                <div class="row mx-2">
                    <div class="col p-2">
                        <form action="{{route('StudentUpload',$school->id)}}" method='POST' enctype='multipart/form-data'>
                            @csrf
                            <div class="input-group">
                                <input type="file" name="form_file_uploaded" id="form_file_uploaded" class="form-control">
                                <button type='submit' class="btn btn-outline-success shadow-sm"><i class="fa fa-upload"></i> Attach CSV file data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection