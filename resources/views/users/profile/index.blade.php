@Extends('layouts.general')
@section('crumbs')
    {{Breadcrumbs::render('Profile')}}
@endsection
@section('content')
    <div class="container">
        <div class="row mx-1">
            <div class="col p-2 border border-primary m-2">
                <div class="row mx-1">
                    <div class="col p-2">
                        <h3>{{Auth::user()->firstName}} - PROFILE</h3>
                    </div>
                </div>
                <hr>
                <div class="row mx-1">
                    <div class="col-md-3 p-2">
                        <img src="{{is_file($profileImage) ? $profileImage : asset('placeholder-profile.jpg')}}" alt="Profile" width='145px' height='150px'>
                    </div>
                    <div class="col p-2 border-left">
                        <div class="row mx-1">
                            <div class="col-md-4 p-2">
                                <label for="">FIRST NAME:</label>
                            </div>
                            <div class="col p-2">
                                {{Auth::user()->firstName}}
                            </div>
                        </div>
                        <div class="row mx-1">
                            <div class="col-md-4 p-2">
                                <label for="">MIDDLE NAME:</label>
                            </div>
                            <div class="col p-2">
                                {{Auth::user()->middleName}}
                            </div>
                        </div>
                        <div class="row mx-1">
                            <div class="col-md-4 p-2">
                                <label for="">LAST NAME:</label>
                            </div>
                            <div class="col p-2">
                                {{Auth::user()->lastName}}
                            </div>
                        </div>
                    </div>
                    <div class="col p-2 border-left">

                    </div>
                </div>
                <hr>
                <div class="row mx-1">
                    <div class="col p-2">
                        <h3 class="p-2">PROFILE EDIT</h3>
                        <hr>
                        <form action="{{route('UserUpdate',$user->id)}}" id="user-edit-form" method='post'>
                            @csrf
                            <div class="p-2 bg-white">
                                <h4 class="p-2 border-bottom">Personal Infomation</h4>
                                <div class="form-group row mx-0">
                                    <div class="col p-2">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" name='firstname' value="{{$user->firstName}}" id='firstName'>
                                    </div>
                                    <div class="col p-2">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" name='lastname' value="{{$user->lastName}}" id='lastName'>
                                    </div>
                                    <div class="col p-2">
                                        <label for="middleName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" name='middlename' value="{{$user->middlename}}" id='middleName'>
                                    </div>
                                </div>
                                <div class="form-group row mx-0">
                                    <div class="col p-2">
                                        <label for="user_email" class="form-label">Email</label>
                                        <input type="text" class="form-control" name='email' value="{{$user->email}}" id='user_email'>
                                    </div>
                                    <div class="col p-2">
                                        <label for="contact" class="form-label">Contact</label>
                                        <input type="text" class="form-control" name='contact' value="{{$user->contact}}" id='contact'>
                                    </div>
                                    <div class="col p-2">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="{{$user->gender}}">{{$user->gender}}</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    @if($user->hasRole('student') && $user->form)
                                        <div class="col p-2">
                                            <label for="middleName" class="form-label">Class</label>
                                            <input type="text" class="form-control" name='class' value="{{$class->form_name}}" id='middleName'>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="p-2 bg-white mt-1">
                                <h4 class="p-2 border-bottom">Identification Information</h4>
                                <div class="row mx-0 p-2">
                                    <div class="col p-2">
                                        <label for="nin">NIN</label>
                                        <input type="text" class="form-control" name='nin' value='{{$user->nin}}' placeholder='Text..'>
                                    </div>
                                    <div class="col p-2">
                                        <label for="nin">Adress</label>
                                        <input type="text" class="form-control" name='address' value="{{$user->address}}" placeholder='Text..'>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 mt-1 bg-white">
                                <h4 class="p-2 border-bottom">Change Password</h4>
                                <div class="row p-2 mx-0">
                                    <div class="col p-2">
                                        <label for="">New Password</label>
                                        <input type="password" class="form-control" name='new_password' placeholder='Enter password..'>
                                    </div>
                                    <div class="col p-2">
                                        <label for="">Re-enter Password</label>
                                        <input type="password" class="form-control" name='new_password' placeholder='Enter password..'>
                                    </div>
                                </div>
                                <div class="row p-2 mx-1">
                                    <div class="col-md-1 p-2">
                                        <input type="checkbox" name="reset" id="reset-password" class="form-check-input ml-4">
                                    </div>
                                    <div class="col p-2">
                                        <label for="reset-password">Change Passord on next login</label>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 bg-white mt-1">
                                <div class="row mx-0">
                                    <div class="col p-2">

                                    </div>
                                </div>
                                <div class="row mx-0">
                                    <div class="col p-2">
                                        <button class="btn btn-sm  btn-flat btn-primary right" type='submit' onclick="blurSection('user-edit-form')">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-2 border border-primary m-2">

            </div>
        </div>
    </div>
@endsection