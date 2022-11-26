@Extends('schools.details')
@section('crumbs')

@endsection
@section('details')
    <div class="container rounded bg-white mt-1 mb-5">
        <form action="{{route('studentUpdate',$student->id)}}" method='post'>
            @csrf
            <div class="p-2 border-bottom h3">
                {{$student->firstname}} {{$student->middlename}} {{$student->lastname}}
            </div>
            <div class="row">
                <div class="col-md-2 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">{{$student->firstname}} {{$student->lastname}}</span><span class="text-black-50">{{$student->email}}</span><span> </span></div>
                </div>
                <div class="col-md-7 border-right">
                    <div class="p-3 py-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-md-3"><label class="labels">Firstname</label><input type="text" name='firstname' class="form-control" placeholder="first name" value="{{$student->firstname}}"></div>
                            <div class="col-md-5"><label class="labels">Middlename</label><input type="text" name='middlename' class="form-control" value="{{($student->middlename) ? $student->middlename :''}}" placeholder="middle name"></div>
                            <div class="col-md-4"><label class="labels">Lastname</label><input type="text" name='lastname' class="form-control" value="{{$student->lastname}}" placeholder="last name"></div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-md-3"><label class="labels">Class</label>
                                <select name="form_id" id="" class="custom-select">
                                    <option value="{{$student->form->id}}">{{$student->form->form_name}}</option>
                                    @foreach($level->forms as $form)
                                        <option value="{{$form->id}}">{{$form->form_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label class="labels">Stream</label>
                                <select name="stream_id" id="" class="custom-select">
                                    <option value="{{($student->stream !='') ? $student->stream->id :''}}">{{($student->stream !='') ? $student->stream->name:'Select'}}</option>
                                    @foreach($school->streams as $stream)
                                        <option value="{{$stream->id}}">{{$stream->name}}</option>
                                    @endforeach
                                </select>                       
                            </div>
                            <div class="col-md-4">
                                <label class="labels">Payment Code</label>
                                <input type="text" name='payment_code' class="form-control" value="{{$student->payment_code}}" placeholder="pay code"></div>
                        </div>
                        <hr>
                        <h4 class="p-2">Biodata</h4>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Contact</label>
                                <input type="text" name='contact' class="form-control" placeholder="enter phone number" value="{{$student->contact}}">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email ID</label>
                                <input type="text" name='email' class="form-control" placeholder="enter email id" value="{{$student->email}}">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Address</label>
                                <input type="text" name='address' class="form-control" placeholder="enter address line 1" value="{{$student->address}}">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">NIN</label>
                                <input type="text" name='nin' class="form-control" placeholder="enter address line 2" value="{{$student->nin}}">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">LIN</label>
                                <input type="text" name='lin' class="form-control" placeholder="enter address line 2" value="{{$student->lin}}">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Nationality</label>
                                <input type="text" name='nationality' class="form-control" placeholder="enter address line 2" value="">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Gender</label>
                                <select name="gender" id="" class='custom-select'>
                                    <option value="{{$student->gender}}">{{$student->gender}}</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="p-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" name ='enable_login' value="{{($student->user_id) ? 'on' : ''}}" {{($student->user_id) ? 'checked' : ''}}>
                                <label class="custom-control-label" for="customSwitch1">Enable User Login</label>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-5 text-right">
                            <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <h4 class="p-2 pt-2">Enrollments </h4>
                    <hr>
                    <div class="p-2 py-1">
                        @foreach($forms as $form)
                            <div class="p-2 my-2 border-bottom">
                                {{$form->form_name}}
                                <span class="right">
                                    {{$form->pivot->year}}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection