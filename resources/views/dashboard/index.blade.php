@Extends('layouts.users')
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2">
                <h3>DASHBOARD</h3>
            </div>
        </div>
        <!--generate user subjects-->
        <div class="row p-2">
            <div class="col">
                <div class="p-2 user-subject-card inline-block">
                    @foreach(Auth::user()->subjects as $subject)
                        <a href="{{route('subject',$subject->id)}}" class="nav-link">
                            <div class="p-2 shadow-sm p-2 subject-card bg-white justify-content-center">
                                <div class="p-2 justify-content-center">
                                    <h3>{{$subject->subject_name}}</h3>
                                    <h6 class="text-muted">
                                        {{$subject->form->form_name}}
                                    </h6>
                                </div>
                                <div class="p-2">
                                    {{$subject->subject_code}}  
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection