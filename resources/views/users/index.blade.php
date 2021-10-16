@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2 bg-white">
            <div class="col p-2">
                <div class="h4 header">Users
                    <span class="right h5">
                        <i class="fa fa-plus btn btn-circle shadow btn-success right" onclick="ShowDiv('new-user-div')"></i>
                    </span>
                </div>
                <table class="table table-sm">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th></th>
                            <th colspan='2'><input type="text" id="user-search" class="custom-input p-2" onkeyup="SearchItem('user-search','school-users','tr')" autocomplete='off' placeholder='Search...'></th>
                            <th colspan='2'>
                                <span class="right p-2 inline-block">
                                    <i class="fa fa-filter m-1"></i>
                                    <i class="fa fa-download m-1"></i>
                                    <i class="fa fa-upload m-1"></i>
                                    <i class="fa fa-filter m-1"></i>
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th>user Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id='school-users'>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->firstName}}</td>
                                <td>{{$user->lastName}}</td>
                                <td>{{$user->email}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$users->links()}}
            </div>
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