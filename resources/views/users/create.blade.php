@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2 ">
                <div class="h4 border-bottom">New User</div>
                <form action="{{route('UserStore')}}" id="new-user-form" method='POST'>
                    @csrf
                    <input type="hidden" name='school_id' value="{{$school->id}}">
                    <div class="form-row mt-1 bg-white">
                        <div class="col p-2">
                            <label for="user-firstName" class="form-labe">First Name</label>
                            <input type="text" class="form-control" name='first_name' id="user-firstName" autocomplete='off' required>
                        </div>
                        <div class="col p-2">
                            <label for="usermiddlename" class="form-labe">Middle Name</label>
                            <input type="text" class="form-control" name='middlename' id="usermiddlename" autocomplete='off'>
                        </div>
                        <div class="col p-2">
                            <label for="user-lastName" class="form-labe">Last Name</label>
                            <input type="text" class="form-control" name='last_name' id="user-lastName" autocomplete='off' required>
                        </div>
                    </div>
                    <div class="form-row mt-1 bg-white">
                        <div class="col p-2">
                            <label for="user-email" class="form-labe">Email</label>
                            <input type="text" class="form-control" name='user_email' id="user-email" autocomplete='off' required>
                        </div>
                        <div class="col p-2">
                                <label for="contact" class="form-label">Contact</label>
                            <input type="text" class="form-control" name='contact' id='contact'>
                        </div>
                        <div class="col p-2">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value=""></option>
                                <option value="Male">Male</option>
                                <option value="Female">female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row user-category bg-white mt-1 ">
                        <div class="col p-2">
                            <label for="user-category" class="form-labe">Category</label>
                            <select name="user-category" id="user-category" class="form-control">
                                <option value="" hidden>Select</option>
                                <option value="Student">Student</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Admin">Admin</option>
                                <option value="ict-admin">Ict-Admin</option>
                                <option value="school-administrator">School-Admin</option>
                            </select>
                        </div>
                        <div class="col p-2">
                            <label for="nin">NIN</label>
                            <input type="text" class="form-control" name='nin' placeholder='Text..'>
                        </div>
                        <div class="col p-2">
                            <label for="nin">Adress</label>
                            <input type="text" class="form-control" name='address' placeholder='Text..'>
                        </div>
                    </div>
                    <div class="form-row mt-1 bg-white">
                        <div class="col hidden student-class">
                            <label for="student-class" class="form-labe">Class</label>
                            <select name="student-class" id="student-class" class="custom-input">
                                <option value="" hidden>Select</option>
                                @foreach($school->forms as $form)
                                    <option value="{{$form->id}}">{{$form->form_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col p-2">
                            <label for="user-password" class="form-labe">Password</label>
                            <input type="password" class="form-control" name='user_password' id="password" autocomplete='off' required>
                        </div>
                    </div>
                    <div class="form-row bg-white">
                        <div class="col p-2">
                            <input type="checkbox" id='showpassword' class='form-check-input mx-2' onclick="ShowPassword()">
                            <label for="showpassword" class="form-check-label ml-4">Show Password</label>
                        </div>
                        <div class="col p-2">
                            <button class="btn btn-sm  btn-flat btn-primary right" type='submit'>Save Data</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection