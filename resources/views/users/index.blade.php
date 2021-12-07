@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2 bg-white">
            <div class="col p-2 ">
                <div class="h4 header">Users
                    <span class="right h5">
                        <i class="fa fa-plus btn btn-circle shadow btn-success right" onclick="ShowDiv('new-user-div')"></i>
                    </span>
                </div>
                <table class="table table-sm" id='users-table'>
                    <thead class="table-light">
                        <tr>
                            <th colspan='3'><input type="text" id="user-search" class="custom-input p-2" onkeyup="SearchItem('user-search','school-users','tr')" autocomplete='off' placeholder='Search...'></th>
                            <th colspan='4'>
                                <span class="right p-2 inline-block">
                                    <a href="" class="nav-link btn btn-sm btn-circle btn-light mx-2"><i class="fa fa-filter mx-2"></i></a>
                                    <a href="" class="nav-link btn btn-sm btn-circle btn-light mx-2"><i class="fa fa-download mx-2"></i></a>
                                    <a href="#upload-users" class="nav-link btn btn-sm btn-circle btn-light mx-2" data-toggle='modal' title='Upload Users' @popper(Upload Users)><i class="fa fa-upload mx-2"></i></a>
                                    <a href="" class="nav-link btn btn-sm btn-circle btn-light mx-2"><i class="fa fa-filter mx-2"></i></a>
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th><img src="{{asset('user-icon.jpg')}}" alt="" width="40px" height="40px" class='rounded-circle'></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Code</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id='school-users' class='school-users-table-body'>
                        @foreach($users as $user)
                            @if(!$user->hasRole(['superadministrator']))
                            <tr>
                                <td><img src="{{asset('user-icon.jpg')}}" alt="" width="50px" height="50px" class='rounded-circle'></td>
                                <td><a href="{{route('userView',$user->id)}}" class="nav-link">{{$user->firstName}} {{$user->lastName}}</a></td>
                                <td>{{$user->email}}</td>
                                <span class='text-muted'>
                                    <td class='text-muted'>{{$user->barcode}}</td>
                                    <td class='text-muted'>{{$user->user_role}}</td>
                                    <td class='text-muted'>{{$user->account_status}}</td>
                                </span>
                                <td><a href="{{route('userView',$user->id)}}" class="nav-link btn btn-sm btn-light btn-circle" @popper(View)><i class="fa fa-eye"></i></a></td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        <!-- modal to upload users-->
            <div class="modal fade" id="upload-users" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="staticBackdropLabel">{{$school->school_name}} Upload Users</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="p-2">
                            <form action="{{route('users.upload')}}" id="upload-users-form" method='POST' enctype='multipart/form-data'>
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="school_id" value="{{$school->id}}">
                                    <label for="uploaded_file">Upload File</label>
                                    <input type="file" name="uploaded_file" id="uploaded_file" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="user-role">Category</label>
                                    <select name="user-role" id="user-role" class="form-control">
                                        <option value="" hidden>Select</option>
                                        <option value="student">Students</option>
                                        <option value="teacher">Teachers</option>
                                        <option value="school-administrator">School-Admins</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for='password'> Uniform - Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input class="form-control" type="password" name="password" id="password">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="password_status" id="password_status" value="change-password" zoom='2'class='form-check-input'>
                                    <label for="password_status" class='form-check-label'>Change Password on next login</label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button  class="btn btn-primary btn-sm" type='submit' form="upload-users-form">upload</button>
                    </div>
                    </div>
                </div>
            </div>

        <!--end modal section -->

            <div class="col-md-4 p-2 new-user-div hidden">
                <div class="h4 border-bottom">New User</div>
                <form action="{{route('UserStore')}}" id="new-user-form" method='POST'>
                    @csrf
                    <input type="hidden" name='school_id' value="{{$school->id}}">
                    <div class="form-group">
                        <label for="user-firstName" class="form-labe">First Name</label>
                        <input type="text" class="custom-input" name='first_name' id="user-firstName" autocomplete='off' required>
                    </div>
                    <div class="form-group">
                        <label for="user-lastName" class="form-labe">Last Name</label>
                        <input type="text" class="custom-input" name='last_name' id="user-lastName" autocomplete='off' required>
                    </div>
                    <div class="form-group">
                        <label for="user-email" class="form-labe">Email</label>
                        <input type="text" class="custom-input" name='user_email' id="user-email" autocomplete='off' required>
                    </div>
                    <div class="form-group user-category">
                        <label for="user-category" class="form-labe">Category</label>
                        <select name="user-category" id="user-category" class="custom-input">
                            <option value="" hidden>Select</option>
                            <option value="Student">Student</option>
                            <option value="Teacher">Teacher</option>
                            <option value="Admin">Admin</option>
                            <option value="ict-admin">Ict-Admin</option>
                            <option value="school-administrator">School-Admin</option>
                        </select>
                    </div>
                    <div class="form-group hidden student-class">
                        <label for="student-class" class="form-labe">Class</label>
                        <select name="student-class" id="student-class" class="custom-input">
                            <option value="" hidden>Select</option>
                            @foreach($school->forms as $form)
                            <option value="{{$form->id}}">{{$form->form_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user-password" class="form-labe">Password</label>
                        <input type="password" class="custom-input" name='user_password' id="password" autocomplete='off' required>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id='showpassword' onclick="ShowPassword()">
                        <label for="" class="form-labe">Show Password</label>
                    </div>
                    <div class="row p-1">
                        <div class="col p-2">
                            <button class="btn btn-sm btn-light" onclick="Close('new-user-div')">Cancel</button>
                            <button class="btn btn-sm btn-primary right" type='submit'>Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
        
    </div>
@endsection