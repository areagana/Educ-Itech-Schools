@Extends('schools.details')
@section('crumbs')
    {{Breadcrumbs::render('users',$school,$school->id)}}
@endsection
@section('details')
    <div class="container-fluid">
        <div class="row p-2 bg-white">
            <div class="col p-2 ">
                <div class="h4 header">Users
                    <span class="right inline-block">
                        <a href="" class="nav-link btn btn-sm btn-circle btn-light"><i class="fa fa-download mx-2"></i></a>
                        <a href="#upload-users" class="nav-link btn btn-sm btn-circle btn-light" data-toggle='modal' title='Upload Users' @popper(Upload Users)><i class="fa fa-upload mx-2"></i></a>
                        <a href="{{route('userCreate',$school->id)}}" class="btn btn-circle shadow btn-success"><i class="fa fa-plus"></i></a>
                    </span>
                </div>
                <div class="p-2 border border-primary">
                    <table class="table table-sm table-striped" id='dataTable'>
                        <thead class="table-info">
                            <tr>
                                <th><input type='checkbox' class='form-check-input m-2' id='check-all'> All</th>
                                <th><img src="{{asset('user-icon.jpg')}}" width="30px" height="30px" class='rounded-circle'></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Code</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                @if(!$user->hasRole(['superadministrator']))
                                <tr>
                                    <td><input type='checkbox' class='form-check-input m-2' id='user_id{{$user->id}}'></td>
                                    <td><img src="{{asset('user-icon.jpg')}}" alt="" width="30px" height="30px" class='rounded-circle'></td>
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
                
            </div>
            
        </div>
        
    </div>
@endsection