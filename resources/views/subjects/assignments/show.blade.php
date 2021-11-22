
@Extends('layouts.subjectView')
@section('crumbs')
    {{Breadcrumbs::render('assignment.show',$subject,$assignment,$subject->id,$assignment->id)}}
@endsection
@include('includes.functions')
@section('subjectContent')
    <div class="container-fluid">
        <div class="row p-0">
            <div class="col-md-9 p-2 bg-white">
                <h3 class='header'>{{$assignment->assignment_name}}
                    @if(Auth::user()->hasRole(['teacher','ict-admin','admininistrator','superadministrator']))
                    <span class="right h5 inline-block">
                        <i class="fa fa-edit btn btn-light"> Edit</i> 
                        <i class="fa fa-trash btn btn-light" onclick="xdialog.confirm('Confirm to delete this assignment?',function(){deleteItem({{$assignment->id}},'/assignment/delete')})"> Delete</i>
                    </span>
                    @endif
                </h3>
                <div class="p-2">
                    {!!$assignment->assignment_content!!}<br>
                    <!--show assignment attachment-->
                    @if($assignment->assignment_attachment)
                        <div class="p-2">
                            <h5 class="header">Attachment</h5>
                            <a href="{{route('DownloadAssignment',$assignment->id)}}" class="nav-link">
                                {{$assignment->assignment_attachment}}
                                <span class="right bg-success p-2 text-white"><i class="fa fa-download"></i> Download</span>
                            </a>
                        </div>
                    @endif
                    <div class="row p-2">
                        <div class="col p-2 text-muted border-top">
                            <div class="p-2">
                                @if($assignment->close_date >= date('Y-m-d'))
                                        <b>{{__('Upcoming')}}</b> <br>
                                        Submission Deadline: <span class="right">{{dateFormat($assignment->close_date,'D jS M Y')}} at {{dateFormat($assignment->close_date,'H:m')}}Hrs</span>
                                @else
                                    <b>{{__('Ended')}} </b><br>
                                    closed on {{$assignment->close_date}}
                                @endif
                            </div>
                            @if(Auth::user()->hasRole(['teacher','administrator','ict-admin','school-administrator','superadministrator']))
                            <div class="p-2">
                            <b>{{__('Submissions')}} </b><br>
                                @if(count($assignment->assignment_submissions) > 0)
                                    {{count($assignment->assignment_submissions)}} submitted
                                    <a href="{{route('gradeAssignment',$assignment->id)}}" class="nav-link">
                                        <span class="right p-2 bg-info text-white">
                                            Grade submimissions
                                        </span>
                                    </a>
                                @else
                                    No submissions yet
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col p-1">
        <!-- enable this for students-->
                   @if(Auth::user()->hasRole(['student','ict-admin','admininistrator','superadministrator']))
                        @if(Auth::user()->assignment_submissions->where('assignment_id',$assignment->id)->count() == 0)
                        <a href="{{route('assignment.attempt',[$subject->id,$assignment->id])}}" class="nav-link">
                            <button class="btn btn-primary btn-sm right">Attempt Assignment</button>
                        </a>
                        @else 
                            <span class="right p-2 bg-info text-white"> Already submitted</span>
                        @endif
                    @endif
                    </div>
                </div>
            </div>
            <div class="col p-2 mx-1 bg-white">
                <h4 class="border-bottom p-2">To Do 
                    <!-- check if user is a teacher or student-->
                    @if(Auth::user()->hasRole(['teacher']))
                        @if($assignment->assignment_submissions->count() > 0)
                            <span class="right h6">Grade ({{$assignment->assignment_submissions->count()}}) submissions </span>
                        @endif
                    @endif
                </h4>
                @if(auth::user()->hasRole(['teacher']))
                    @if($assignment->assignment_submissions->count() > 0)
                        @foreach($assignment->assignment_submissions as $submitted)
                            <div class="p-2 mt-1 to-grade">
                                {{$submitted->user->firstName}} {{$submitted->user->lastName}} <br>
                                {{$submitted->attachment_name}}
                            </div>
                        @endforeach
                    @else
                        <div class="p-2 border">
                            No submissions
                        </div>
                    @endif
                @elseif(Auth::user()->hasRole(['student']))
            <!-- check if user has submitted-->
                    @php
                        $submission = $assignment->assignment_submissions()->where('user_id',Auth::user()->id)->get();
                    @endphp
                    @if($submission->count() > 0)
                        @foreach($submission as $work)
                            <div class="p-2">
                                Grade: <span class="right">{{$work->submitted_grade / $assignment->total_points * 100}} %</span> <br> <br>
                                @if($work->submission_comments->count() > 0)
                                    @foreach($work->submission_comments as $comment)
                                        <div class="p-2 border mt-1">
                                            {{$comment->comment}} <br>
                                            <span class="text-muted">
                                                {{$comment->user->firstName}} {{$comment->user->lastName}}
                                                <span class="right">
                                                    {{dateFormat($comment->created_at,'H:m')}} Hrs
                                                </span>
                                            </span>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="p-2">
                            <h4>Submit assignment for grading</h4>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="row p-1">
            <div class="col p-2">
                

            </div>
        </div>
    </div>
@endsection