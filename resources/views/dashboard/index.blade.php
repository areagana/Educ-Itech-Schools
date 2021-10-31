@Extends('layouts.users')
@section('content')
    <div class="container-fluid">
        <!--generate user subjects-->
        <div class="row p-2">
            <div class="col">
                <div class="p-2 inline-block">
                    @if(!empty($subjects))
                        @foreach($subjects as $subject)
                        <div class="p-2 card shadow-sm bg-white justify-content-center m-2">
                            <a href="{{route('subject',$subject->id)}}" class="nav-link">
                                <div class="p-2">
                                    <div class="p-2 justify-content-center">
                                        <h3>{{$subject->subject_name}}
                                            
                                        </h3>
                                        <h6 class="text-muted">
                                            {{$subject->form->form_name}}
                                        </h6>
                                    </div>
                                    <div class="p-2">
                                        {{$subject->subject_code}}  
                                    </div>
                                </div>
                            </a>
                            <div class="row p-2">
                                <div class="col p-2 border-top">
                                <span class="right">
                                    <i class="fa fa-ellipsis-v btn btn-sm btn-circle btn-light ellipsis"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="p-3 border border-primary">
                            No school term set.
                            Your subjects will appear when the school term setup is complete.
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-3 p-2 border-left">
                @if(empty($term->items))
                    <div class="header p-2 h5">
                        PREVIOUR SUBJECTS
                    </div>
                    @foreach(Auth::user()->subjects as $subject)
                    <a href="{{route('subject',$subject->id)}}" class="nav-link">
                        <div class="p-2">
                            {{$subject->subject_code}}
                            <span class="right text-muted">
                                {{$subject->term->term_name}} {{$subject->term->term_year}}
                            </span>
                        </div>
                    </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection