@Extends('layouts.users')
@include('includes.functions')
@section('content')
    <div class="container-fluid">
        <!--generate user subjects-->
        <div class="row p-2">
            <div class="col">

        <!-- include announcements here-->
        <div class="p-2">
            @foreach($notices as $notice)
                @php
                    $notice_users = json_decode($notice->users);
                @endphp
        <!--checks if no users were selected-->
                @if($notice_users == 'NULL')
                    <div class="p-2 bg-white border border-primary shadow-sm mt-2">
                        <div class="p-2 header h5">
                            {{$notice->announcement_title}}
                            {{var_dump($notice_users)}}
                            <span class="right btn btn-light btn-sm">
                                &times;
                            </span>
                        </div>
                        <div class="p-2">
                            {!!$notice->announcement_content!!}
                        </div>
                    </div>
                @endif
                @if(Auth::user()->hasRole($notice_users))
                    <div class="p-2 bg-white shadow-sm mt-2 notice-card notice-card{{$notice->id}}">
                        <div class="p-2 header h5 text-primary">
                            <i>{{$notice->announcement_title}}</i>
                            <span class="right btn btn-light btn-sm" @popper(Close) onclick="Close('notice-card{{$notice->id}}')">
                                &times;
                            </span>
                    <!--provide ownload link for the attachments if available-->
                            @if($notice->announcement_attachment)
                            <span class="right inline-block h6">
                                <a href="{{route('announcement.download',$notice->id)}}" class="nav-link"><i class="fa fa-download"></i><i> Download Attachment</i></a>
                            </span>
                            @endif
                        </div>
                        <div class="p-2">
                            {!!$notice->announcement_content!!}
                        </div>
                        <div class="row">
                            <div class="col p-2">
                                <span class="right mx-2">
                                    <i>{{dateFormat($notice->start_date,'D jS M, Y')}}</i>
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <!--end announcements section-->
                <div class="p-2 inline-block">
                    @if(!empty($subjects))
                        @foreach($subjects as $subject)
                        <div class="p-2 card shadow-sm bg-white justify-content-center m-2" style='height:320px;width:280px;'>
                            <div class="row p-1 mb-4">
                                <div class="col p-1">
                                    <a href="{{route('subject',$subject->id)}}" class="nav-link">
                                        <div class="p-2">
                                            <div class="p-2 justify-content-center">
                                                <h4>{{$subject->subject_name}}</h4>
                                                <h6 class="text-muted">
                                                    {{$subject->form->form_name}}
                                                </h6>
                                            </div>
                                            <div class="p-2">
                                                {{$subject->subject_code}}  
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="row p-2 mb-1">
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
                @if(!$term)
                    <div class="header p-2 h5">
                        PREVIOUS SUBJECTS
                    </div>
                    @foreach(Auth::user()->subjects as $previous)
                    <a href="{{route('subject',$previous->id)}}" class="nav-link">
                        <div class="p-2">
                            {{$previous->subject_code}}
                            <span class="right text-muted">
                                {{$previous->term->term_name}} {{$previous->term->term_year}}
                            </span>
                        </div>
                    </a>
                    @endforeach
                @else
                    @if(Auth::user()->hasRole(['teacher']))
                    <div class="header h5">TO-DO
                            <span class="right">
                                Grade
                            </span>
                        </div>
                        @foreach($subjects as $subject)
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
                        @endforeach
                        <h4 class="header">Up Coming</h4>
                <!--change heading basng on role-->
                    @elseif(Auth::user()->hasRole(['student']))
                            <h4 class="header">TO-DO</h4>
                        @endif
                            @if(count($pendings) > 0)
                                @foreach($pendings as $todo)
                                <a href="{{route('assignment.show',[$subject->id,$todo->id])}}" class="nav-link">
                                    <div class="p-2 assignment-notification">
                                        {{$todo->assignment_name}} <span class="right text-muted">Points: ({{$todo->total_points}})</span> <br>
                                        <span class="text-muted">
                                            {{$todo->subject->subject_name}} <br>
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
            <!-- include work for the student that has been graded-->
                    @if(Auth::user()->hasRole(['student']))
                    <!--students work pending grading-->
                    @if($ungraded->count() > 0)
                        <h5 class="header">Pending Grading</h5>
                        
                            @foreach($ungraded as $docs)
                                <a href="" class="nav-link mt-1">
                                    <div class="assignment-notification row p-1">
                                        <div class="p-2 col-md-1">
                                            <i class="fa fa-times" style="font-size:16px"></i>
                                        </div>
                                        <div class="p-2 col">
                                            <span class="">{{$docs->assignment->assignment_name}}</span> <br>
                                            <span class="text-muted">
                                                {{$docs->assignment->user->firstName}} {{$docs->assignment->user->lastName}}
                                                <span class="right">
                                                    {{dateFormat($docs->created_at,'jS M y')}} <br>
                                                </span> 
                                            </span>
                                        </div>   
                                    </div>
                                </a> 
                            @endforeach
                        @endif
                    <!-- end section of displaying ungraded work-->

                        <h5 class="header">Recently Graded
                            <span class="right h6"><i>Click to View details</i></span>
                        </h5>
                        @foreach($graded as $doc)
                            <a href="{{route('showFeedback',$doc->id)}}" class="nav-link mt-1">
                                <div class="assignment-notification row p-1">
                                    <div class="p-2 col-md-1">
                                        <i class="fa fa-check" style="font-size:16px"></i>
                                    </div>
                                    <div class="p-2 col">
                                        <span class="text-success">{{$doc->assignment->assignment_name}}</span> <br>
                                        Grade: {{assignmentAge($doc->submitted_grade,$doc->assignment->total_points)}}% <br>
                                        
                                        <span class="text-muted">
                                            {{$doc->teacher->firstName}} {{$doc->teacher->lastName}}
                                            <span class="right">
                                                {{dateFormat($doc->updated_at,'jS M y')}} <br>
                                            </span> 
                                        </span>
                                    </div>   
                                </div>
                            </a> 
                        @endforeach
                    @endif
               @endif
            </div>
        </div>
    </div>
@endsection