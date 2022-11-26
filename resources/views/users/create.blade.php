@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2 bg-white">
            <div class="col p-2 ">
                <div class="h4 border-bottom">New User</div>
                <form action="{{route('UserStore')}}" id="new-user-form" method='POST'>
                    @csrf
                    <input type="hidden" name='school_id' value="{{$school->id}}">
                    <div class="form-row">
                        <div class="col p-2">
                            <label for="user-firstName" class="form-labe">First Name</label>
                            <input type="text" class="custom-input" name='first_name' id="user-firstName" autocomplete='off' required>
                        </div>
                        <div class="col p-2">
                            <label for="user-lastName" class="form-labe">Last Name</label>
                            <input type="text" class="custom-input" name='last_name' id="user-lastName" autocomplete='off' required>
                        </div>
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
                            <button class="btn btn-sm btn-primary right" type='submit'>Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection