@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2 bg-white">
            <div class="col-md-4 p-2">
                <b>Account No:</b> {{$user->id}}
                @if($user->barcode)
                    {!! DNS1D::getBarcodeHTML($user->barcode, 'UPCA') !!}
                    {{$user->barcode}}
                @else
                    {!! DNS1D::getBarcodeHTML('100', 'UPCA') !!}
                    {{__(100)}}
                @endif
            </div>
            <div class="col-md-6 p-2">
                <b>First Name:</b> {{$user->firstName}} <br>
                <b>Last Name:</b> {{$user->lastName}} <br>
                @if($user->hasRole('student') && $user->form)
                    <b>Class:</b> {{$class->form_name}} 
                @endif
            </div>
            <div class="col-md-2 p-2">
                <img src="{{asset('user-icon.jpg')}}" alt="" width='120px' height='90px'>
            </div>
        </div>
        <div class="row p-2 bg-white">
            <div class="col p-2 border-top">
                <span class="inline-block">
                    @if($user->account_status == 'active')
                        <a href="#" class="nav-link" onclick="xdialog.confirm('Confirm to SUSPEND this account?',function(){suspendAccount({{$user->id}})})"><i class="fa fa-share" ></i> Suspend</a>
                    @elseif($user->account_status == 'suspended' || $user->account_status == null)
                        <a href="#" class="nav-link" onclick="xdialog.confirm('Confirm to activate this account?',function(){activateAccount({{$user->id}})})"><i class="fa fa-check"></i> Activate</a>
                    @endif
                    <a href="#" class="nav-link"><i class="fa fa-file"></i> Reports</a>
                    <a href="#" class="nav-link"><i class="fa fa-flag"></i> Records</a>
                    <a href="#add-role" class="nav-link" data-toggle='modal'><i class="fa fa-lock"></i> Add Role</a>
                    <a href="#" class="nav-link" onclick="ShowDiv('enrollteacher{{$user->id}}')"><i class="fa fa-clock"></i> Schedules</a>
                </span>
                <span class="right">
                    @if($user->account_status === 'active')
                        <span class="text-primary h6">{{__('ACTIVE')}}</span>
                    @elseif($user->account_status =='suspended')
                        <span class="text-danger h6">{{__('SUSPENDED')}}</span>
                    @else
                        <span class="text-info h5">{{__('INACTIVE')}}</span>
                    @endif
                </span>
            </div>

    <!--modal to add role to user-->
            <div class="modal fade" id="add-role" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h3 class="modal-title" id="staticBackdropLabel">Add Role</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="p-2">
                            <form action="{{route('addUserRole')}}" id="add-role-to-user" method='POST'>
                                @csrf
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                @foreach($roles as $role)
                                    @if(!Auth::user()->hasRole(['superadministrator']) && $role->id < 2)
                                        @continue;
                                    @endif
                                    <div class="form-check h4 mx-2">
                                        <input type="checkbox" name="role_id[]" id="role{{$role->id}}" class="form-check-input" value="{{$role->id}}"
                                            @if(in_array($role->name,$user_roles))
                                                {{_('checked')}}
                                            @endif
                                        >
                                        <label for="role{{$role->id}}" class="form-check-label m-2">{{$role->display_name}}</label>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button  class="btn btn-primary btn-sm" type='submit' form="add-role-to-user">Save</button>
                    </div>
                    </div>
                </div>
            </div>
    <!-- end modal section-->

        </div>
        <div class="row p-2 bg-white mt-2 user-edit-form">
            <div class="col p-3">
                <h3 class="header">{{$user->firstName}} {{$user->lastName}} <span class="right text-muted">Profile</span></h3>
                <form action="" id="user-edit-form" method='post'>
                    @csrf
                    <div class="form-group row">
                        <div class="col p-2">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" name='firstName' value="{{$user->firstName}}" id='firstName'>
                        </div>
                        <div class="col p-2">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name='lastName' value="{{$user->lastName}}" id='lastName'>
                        </div>
                        <div class="col p-2">
                            <label for="middleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name='middleName' value="{{$user->lastName}}" id='middleName'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col p-2">
                            <label for="firstName" class="form-label">Email</label>
                            <input type="text" class="form-control" name='email' value="{{$user->email}}" id='firstName'>
                        </div>
                        <div class="col p-2">
                            <label for="lastName" class="form-label">School</label>
                            <input type="text" class="form-control" name='school' value="{{$school->school_name}}" id='lastName' readonly>
                        </div>
                        @if($user->hasRole('student') && $user->form)
                        <div class="col p-2">
                            <label for="middleName" class="form-label">Class</label>
                            <input type="text" class="form-control" name='class' value="{{$class->form_name}}" id='middleName'>
                        </div>
                        @elseif($user->hasRole('teacher'))
                        <div class="col p-2">
                            <b>Subjects:</b><br>
                            @if($subjects)
                                @foreach($subjects as $subject)
                                    {{$subject->subject_name}}
                                @endforeach
                            @else
                                <div class="alert alert-info alert-sm">
                                    No subjects for user
                                </div>
                            @endif
                        </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <button class="btn btn-sm btn-primary right" type='submit' onclick="blurSection('user-edit-form')">Save</button>
                        </div>
                    </div>
                </form>                
            </div>
        </div>
        <div class="row mt-2">
            <div class="col p-2 bg-white">
                <h4 class="header text-primary">Current Enrollments</h4>
                <input type="checkbox" class='hidden' name="teacher_id" value="{{$user->id}}" checked>
                @if(count($current_subjects) > 0)
                    @foreach($current_subjects as $subject)
                        <div class="p-2 enrollment-subject header h5">&nbsp;&nbsp;&nbsp;
                            {{$subject->subject_name}}
                            <span class="text-muted h6">
                                {{$subject->term->term_name}}
                            </span>
                            <span class="right">
                                <button class='btn btn-sm' @popper(unroll) title='unroll' onclick="xdialog.confirm('you are sure to remove {{$subject->subject_name}} from user?',function(){unEnrollStudents({{$subject->id}},checkedBoxes('teacher_id'),'')})">&times;</button>
                            </span>
                        </div>
                    @endforeach
                @else
                    <div class="p-2 h5">
                        <i>No Subjects enrolled currently </i>
                    </div>
                @endif
            </div>
            <div class="col p-2 bg-white mx-1">
                <h4 class="header text-success">All Enrollments</h4>
                @foreach($user->subjects as $subject)
                    <div class="p-2 enrollment-subject header h5">&nbsp;&nbsp;&nbsp;
                        {{$subject->subject_name}}
                        <span class="text-muted h6">
                            {{$subject->term->term_name}}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- schedules-->
        <div class="shadow position-absolute border hidden bg-white border-primary floating-div user-schedules enrollteacher{{$user->id}}">
            <div class="p-2 bg-primary text-white h4">
                {{$user->firstName}} {{$user->lastName}} - Schedules
                <span class="right bg-danger px-2" style="cursor:pointer" title='Close' onclick="Close('user-schedules')">&times;</span>
            </div>
            <div class="p-2">
                <div class="border-bottom p-2 h4">Subjects:  
                    @if($user->subjects)
                        @foreach($user->subjects as $subject)
                            {{$subject->subject_name}}, &nbsp;
                        @endforeach
                    @else
                        {{__('No subjects enrolled')}} 
                    @endif
                </div> 
                <div class="header h4">Schedules
                    <span class="right inline-block h6">
                        <a href="#new-schedule" class="nav-link" data-toggle='modal'><i class="fa fa-plus-circle"> Schedule</i></a>
                        <a href="" class="nav-link"><i class="fa fa-plus-circle"> Subject</i></a>
                    </span>
                </div>
                    <table class="table table-sm table-striped">
                        <thead class="table-info">
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Term</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id='teacher-schedule-table'>
                            @foreach($user->subjects as $key => $subject)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$subject->subject_code}}</td>
                                    <td>{{$subject->subject_name}}</td>
                                    <td>{{$subject->form->form_name}}</td>
                                    <td>{{$subject->term->term_name}}</td>
                                    <td>
                                        @if($subject->term == $term)  
                                            <i class="fa fa-minus btn-outline-danger p-2 btn btn-sm" onclick="xdialog.confirm('you are sure to remove {{$subject->subject_name}} from user?',function(){unEnrollStudents({{$subject->id}},checkedBoxes('teacher_id'),'')})"> Remove</i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade FloatingDiv" id="new-schedule" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Teacher schedule</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="p-2">
                                    <form id="new-schedule-form" method='POST'>
                                        @csrf
                                        <div class="form-group">
                                            <input type="checkbox" class='hidden' name="teacher" value="{{$user->id}}" checked>
                                            <label for="school-classes" class="form-label">Class</label>
                                            <select name="school-classes" id="school-classes" class="custom-select" onchange="loadSubjects($(this).val(),'class_subjects')">
                                                <option value="">Select</option>
                                                @foreach($school->forms as $form)
                                                    <option value="{{$form->id}}">{{$form->form_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="class_subjects" class='form-label'>Subject</label>
                                            <select name="class_subjects" id="class_subjects" class="custom-select">
                                                <option value="">Select class first</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                <button  class="btn btn-primary btn-sm" type='submit' onclick="subjectEnroll($('#class_subjects').val(),checkedBoxes('teacher'))">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
@endsection