@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2 bg-white">
            <div class="col-md-4 p-2">
                <b>User_id:</b> {{$user->id}}
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
                @if($user->hasRole('student'))
                    <b>Class:</b> {{$class->form_name}} 
                @endif
            </div>
            <div class="col-md-2 p-2">
                <img src="" alt="" width='80px' height='90px'>
            </div>
        </div>
        <div class="row p-2 bg-white">
            <div class="col p-2">
                <i class="fa fa-edit"></i> Edit
            </div>
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
                        @if($user->hasRole('student'))
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
        <div class="row p-2 mt-2">
            <div class="col p-2 bg-white mx-1">
                <h4 class="header">Current Enrollments</h4>
                @foreach($current_subjects as $subject)
                    <div class="p-2 enrollment-subject header h5">&nbsp;&nbsp;&nbsp;
                        {{$subject->subject_name}}
                        <span class="text-muted h6">
                            {{$subject->term->term_name}}
                        </span>
                        <span class="right">
                            <button class='btn btn-sm' @popper(unroll) title='unroll' onclick="xdialog.confirm('you are sure to remove {{$subject->subject_name}} from user?',function(){})">&times;</button>
                        </span>
                    </div>
                @endforeach
            </div>
            <div class="col p-2 bg-white mx-1">
                <h4 class="header">All Enrollments</h4>
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
    </div>
@endsection