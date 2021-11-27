@Extends('layouts.subjectView')
@include('includes.functions')
@section('crumbs')
    {{Breadcrumbs::render('subject',$subject,Auth::user()->school,Auth::user()->school->id)}}
@endsection
@section('subjectContent')
    <div class="row mx-1">
        <div class="col p-2 bg-white">
            <div class='p-2 subject-card-home bg-white'>
                <h4 class='header'>To-Do</h4>
                @if(Auth::user()->hasRole(['teacher']))
                        @foreach($subject->assignments as $assignment)
                            @php
                                $pendings = $assignment->assignment_submissions->where('submission_grade','');
                            @endphp
                                @if($pendings->count() > 0)
                                    @foreach($pendings as $pending)
                                        <a href="{{route('assignment.show',[$subject->id,$pending->id])}}" class="nav-link">
                                            <div class="p-2 assignment-notification">
                                                {{$pending->assignment->assignment_name}} <span class="right text-muted">Points: ({{$pending->assignment->total_points}})</span> <br>
                                                <span class="text-muted">
                                                    {{$pending->assignment->subject->subject_name}} <br>
                                                    <span class="">
                                                        {{$pending->user->firstName}} {{$pending->user->lastName}}
                                                    </span> <br>
                                                    <span class="">
                                                        Submitted: {{dateFormat($pending->created_at,'D jS M, H:i')}} Hrs
                                                    </span>
                                                </span>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                        @endforeach
                @endif
                @if(Auth::user()->hasRole(['student']))
                    
            
                            @if(count($pendings) > 0)
                                @foreach($pendings as $todo)
                                <a href="{{route('assignment.show',[$subject->id,$todo->id])}}" class="nav-link">
                                    <div class="p-2 assignment-notification">
                                        {{$todo->assignment_name}} <span class="right text-muted">Points: ({{$todo->total_points}})</span> <br>
                                        <span class="text-muted">
                                            {{$subject->subject_name}} <br>
                                            <span class="">
                                                Submission: {{dateFormat($todo->closing_date,'D jS M, H:s')}} Hrs
                                            </span> <br>
                                            <span class="">
                                                Closing Date: {{dateFormat($todo->end_date,'D jS M, H:s')}} Hrs
                                            </span>
                                        </span>
                                    </div>
                                </a> 
                                @endforeach
                            @else
                                <div class="p-2 h5">
                                    <i>No Activities</i>
                                </div>
                            @endif   
                @endif
            </div>
            <div class='p-2 subject-card-home'>
                <h4 class='header'>Recent Activity</h4>
                @foreach($previous as $event)
                    <div class="p-2 border border-light m-1">
                        {{$event->assignment_name}}
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-2 p-2 bg-white ml-1">
            <div class='header h5'>Upcoming ...</div>
                <div class='p-2'>
                @if($upcoming !='')
                    @foreach($upcoming as $event)
                        <div class="p-2 border border-light">
                            {{$event->assignment_name}}
                        </div>
                    @endforeach
                @else
                    <div class="p-2">
                        No upcoming events
                    </div>
                @endif
                </div>
            <div class='header h5'>Past Events</div>
                    <div class='p-2'>
                    @if($previous !='')
                        @foreach($previous as $event)
                            <div class="p-2">
                                {{$event->assignment_name}}
                            </div>
                        @endforeach
                    @else
                        <div class="p-2">
                            No ended events
                        </div>
                    @endif
                </div>
        </div>
    </div>
@endsection