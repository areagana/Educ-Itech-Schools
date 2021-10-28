@Extends('schools.details')
@section('details')
    <div class="container-fluid">
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
                    </span>
                </div>
            </div>
        </div>
        <div class="row p-2 bg-white mt-2">
            <div class="col p-2">
                <div class="card border border-primary p-2">
                    <div class="form-student-title border-bottom border-primary h4 hidden"></div>
                    <table class="table table-sm">
                        <thead class="table-info" id='student-table-thead'>
                            <tr>
                                <th>
                                    <input type="checkbox" name="school_student[]" id="check_all">
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
                                        <input type="checkbox" name="school_student[]" id="{{$school->school_code}}{{$student->id}}">
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
                                            <a href="#" class="nav-link btn btn-circle btn-sm btn-white"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="nav-link btn btn-circle btn-sm btn-white"><i class="fa fa-trash"></i></a>
                                            <a href="#" class="nav-link btn btn-sm btn-white btn-circle right"><i class="fa fa-ellipsis-v"></i></a>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row p-2">
                        <div class="col p-2 pagination">

                        </div>
                    </div>
                </div>
            </div>
            {{$students->links()}}
        </div>
    </div>
@endsection