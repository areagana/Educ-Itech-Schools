@Extends('layouts.subjectView')
@include('includes.functions')
@section('crumbs')
    {{Breadcrumbs::render('assignments',$subject,$school->id)}}
@endsection
@section('subjectContent')
    <div class="container-fluid">
        <div class="row p-1 bg-white">
            <div class="col p-1">
                <div class="h4 border-bottom">Assignments</div>
            </div>
        </div>
        <div class="row p-1 mt-1">
            <div class="col p-2 bg-white">
                    <div class="accordion m-3" id="accordionAssignment">
                        <div class="card">
                            <div class="card-header" id="headingAssignment">
                                <h4 class="mb-0">
                                    <span  data-toggle="collapse" data-target="#collapseAssignment" aria-expanded="true" aria-controls="collapseOne">
                                        ASSIGNMENTS
                                    </span>
                                    @if(Auth::user()->isAbleTo('assignment-create'))
                                    <span class="right h6">
                                        <a href="{{route('CreateAssignments',$subject->id)}}" class="nav-link bg-secondary text-white"><i class="fa fa-plus"></i> Create</a>
                                    @endif
                                </h4>
                            </div>
                            <div id="collapseAssignment" class="collapse show" aria-labelledby="headingAssignment" data-parent="#accordionAssignment">
                                <div class="card-body">
                                @if(count($assignments) >= 1)
                                    @foreach($assignments as $assignment)
                                    <a href="{{route('assignment.show',[$subject->id,$assignment->id])}}" class="nav-link draggable" ondragstart='' ondragend="">
                                        <div class="p-2 border row assignment bg-white" >
                                            <div class="col-md-1 inline-block border-right">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </div>
                                            <div class="col">
                                                {{$assignment->assignment_name}}
                                                    <span class="right text-muted">
                                                        Due: {{dateFormat($assignment->end_date,'D jS M Y')}}
                                                    </span>
                                                <div class="p-1 text-muted assignment-state">
                                                    @if($assignment->close_date >= date('Y-m-d'))
                                                        Deadline: {{dateFormat($assignment->close_date,'D jS M Y')}} at {{dateFormat($assignment->close_date,'H:m')}}Hrs
                                                    @else
                                                        closed on {{$assignment->close_date}}
                                                    @endif
                                                    <span class="right text-muted">
                                                        @if(count($assignment->assignment_submissions)>0)
                                                            {{count($assignment->assignment_submissions)}} Submitted
                                                        @else
                                                            No Submissions
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                @else
                                    <div class="col p-2">
                                        <h3>No Assignments Created</h3>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-3 p-2 bg-white ml-2">
                <div class="h5 border-bottom">Upcoming</div>
            </div>
        </div>
    </div>
@endsection