@Extends('schools.details')
@section('crumbs')

@endsection
@section('details')
    <div class="container rounded bg-white mt-1 mb-5">
        <form action="{{route('student.store',$school->id)}}" method='post'>
            @csrf
            <div class="p-2 border-bottom h3">
                Fill Student Details
            </div>
            <div class="row">
                <div class="col-md-2 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="{{asset('placeholder-profile.jpg')}}">
                        <span class="font-weight-bold">Profile Image</span>
                        <span class="text-black-50"></span>
                        <span> </span>
                    </div>
                </div>
                <div class="col-md-7 border-right">
                    <div class="p-3 py-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Student Information</h4>
                        </div>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-md-3"><label class="labels">Firstname</label><input type="text" name='firstname' class="form-control" placeholder="first name"></div>
                            <div class="col-md-5"><label class="labels">Middlename</label><input type="text" name='middlename' class="form-control" placeholder="middle name"></div>
                            <div class="col-md-4"><label class="labels">Lastname</label><input type="text" name='lastname' class="form-control"  placeholder="last name"></div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-md-3"><label class="labels">Class</label>
                                <select name="form_id" id="" class="custom-select">
                                    <option value="">Select</option>
                                    @foreach($school->forms as $form)
                                        <option value="{{$form->id}}">{{$form->form_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label class="labels">Stream</label>
                                <select name="stream_id" id="" class="custom-select">
                                    <option value="">Select</option>
                                    @foreach($school->streams as $stream)
                                        <option value="{{$stream->id}}">{{$stream->name}}</option>
                                    @endforeach
                                </select>                        
                            </div>
                            <div class="col-md-4">
                                <label class="labels">Payment Code</label>
                                <input type="text" name='payment_code' class="form-control"  placeholder="pay code"></div>
                        </div>
                        <hr>
                        <h4 class="p-2">Biodata</h4>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Contact</label>
                                <input type="text" name='contact' class="form-control" placeholder="enter phone number">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email ID</label>
                                <input type="email" name='email' class="form-control is-invalid" placeholder="enter email id" required>
                                <div class="invalid-feedback">
                                    Please provide a valid email address.
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Address</label>
                                <input type="text" name='address' class="form-control" placeholder="enter address line 1">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">NIN</label>
                                <input type="text" name='nin' class="form-control" placeholder="NIN">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">LIN</label>
                                <input type="text" name='lin' class="form-control" placeholder="LIN">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Nationality</label>
                                <input type="text" name='nationality' class="form-control" placeholder="Nationality">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Gender</label>
                                <select name="gender" id="" class='custom-select'>
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="p-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" name ='enable_login'>
                                <label class="custom-control-label" for="customSwitch1">Enable User Login</label>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-5 text-right">
                            <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection