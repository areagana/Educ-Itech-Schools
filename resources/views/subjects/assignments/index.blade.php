@Extends('subjects.view')
@include('includes.functions')
@section('crumbs')
    {{Breadcrumbs::render('assignments',$subject,$school->id)}}
@endsection
@section('subjectContent')
    <div class="container-fluid">
        
        <div class="row p-2">
            <div class="col p-2">
                <div class="h4 border-bottom">Assignments
                    @if(Auth::user()->isAbleTo('assignment-create'))
                    <span class="right mb-2">
                        <a href="{{route('CreateAssignments',$subject->id)}}" class="nav-link"><button class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i> Assignment</button></a>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col p-2">
                @foreach($assignments as $assignment)
                    <div class="p-2 border border-primary shadow-sm m-1 row assignment bg-white">
                        <div class="col-md-1">
                            <i class="fa fa-file"></i>
                        </div>
                        <div class="col">
                            <h5>{{$assignment->assignment_name}}</h5>
                            <span class="right text-muted">
                                Due: {{dateFormat($assignment->end_date,'D jS M Y')}}
                            </span>
                            <div class="p-1 text-muted assignment-state">
                                @if($assignment->close_date >= date('Y-m-d'))
                                    Submission Deadline: {{dateFormat($assignment->close_date,'D jS M Y')}} at {{dateFormat($assignment->close_date,'H:m')}}Hrs
                                @else
                                    closed on {{$assignment->close_date}}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-3 p-2">
                <div class="h5 border-bottom">Upcoming</div>
            </div>
        </div>
    </div>
@endsection