@Extends('schools.details')
@section('crumbs')

@endsection
@section('details')
    <div class="container rounded bg-white mt-1 mb-5">
        <div class="p-2 border-bottom h3">
            {{$student->firstname}} {{$student->middlename}} {{$student->lastname}}
            <!-- <span class="text-right">
                <a href="/students/$student->id/edit" class="nav-link">Edit</a>
            </span> -->
        </div>
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="{{asset('placeholder-profile.jpg')}}"><span class="font-weight-bold">{{$student->firstname}} {{$student->lastname}}</span><span class="text-black-50">{{$student->email}}</span><span> </span></div>
                <div class="p-2">
                    <b>ADDRESS:</b> {{$student->address}}
                </div>
                <div class="p-2">
                    <b>CONTACT:</b> {{$student->contact}}
                </div>
                <div class="p-">
                    <b>NIN:</b> {{$student->nin}}
                </div>
                <div class="p-2">
                    <b>LIN:</b> {{$student->lin}}
                </div>
                
            </div>
            <div class="col-md-7 border-right">
                <div class="p-3 py-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <div class="col-md-6 p-2">
                            <div class="p-2">
                                <b> Firstname: </b>{{($student->firstname) ? $student->firstname :''}}
                            </div>
                            <div class="p-2">
                                <b> Middlename:</b> {{($student->middlename) ? $student->middlename :''}}
                            </div>
                            <div class="p-2">
                                <b> Lastname:</b> {{($student->lastname) ? $student->lastname :''}}
                            </div>
                            <div class="p-2">
                                <b> Gender:</b> {{$student->gender}}
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <div class="p-2">
                                <b>CLASS: </b> {{$student->form->form_name}}
                            </div>
                            <div class="p-2">
                                <b>STREAM: </b> {{($student->stream !='') ? $student->stream->name:''}}
                            </div>
                            <div class="p-2">
                                <b>PAYMENT CODE: </b> {{$student->payment_code}}
                            </div>
                            <div class="p-2">
                                <b>EMAIL: </b> {{$student->email}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mx-1">
                        <div class="col p-2">
                            <div class="h5 p-2">EXAMS DONE</div> <hr>
                            @foreach($exams_done as $exam)
                                <a href="" class="nav-link">{{$exam->exam_name}}</a>
                            @endforeach
                        </div>
                        <div class="col p-2">
                            <h4 class=" h5 p-2">EXAM REPORTS</h4> <hr>
                        </div>
                    </div>            
                    
                </div>
            </div>
            <div class="col-md-2">
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
    </div>
@endsection