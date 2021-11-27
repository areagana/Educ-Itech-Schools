
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
                        <i class="fa fa-edit btn btn-light" data-toggle ='modal' data-target='#assignment{{$assignment->id}}'> Edit</i> 
                        <i class="fa fa-trash btn btn-light" onclick="xdialog.confirm('Confirm to delete this assignment?',function(){deleteItem({{$assignment->id}},'/assignment/delete')})"> Delete</i>
                    </span>
                    @endif
                </h3>
                <!--modal to edit assignment-->
                <div class="modal fade" id="assignment{{$assignment->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">{{$assignment->assignment_name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="p-2">
                            <form action="{{route('updateAssignment')}}" id="edit-assignment{{$assignment->id}}" method='POST' enctype='multipart/form-data'>
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                        <input type="hidden" name="assignment_id" value="{{$assignment->id}}">
                                        <label for="assignment_title" class="form-label">Assignment Title</label>
                                        <input type="text" name="assignment_title" id="assignment_title" value="{{$assignment->assignment_name}}" class="form-control" required autocomplete='off' placeholder='Title...'>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Assignment Content</label>
                                        <textarea type="text" name="assignment_content" id="assignment_content" class="form-control" required autocomplete='off'>{!!$assignment->assignment_content!!}</textarea>
                                        <div class=" row">
                                            <div class="col">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <h5 class="header"><i class="fa fa-paperclip"></i> Attachment</h5>
                                        <div class="col-md-6 p-2">
                                            <label for="assignment-attachment" class="form-label">Attachment</label>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <input type="file" name="attachment" id="assignment-attachment" class="form-control">
                                            @if ($errors->has('attachment'))
                                                <span class="errormsg text-danger">{{ $errors->first('attachment') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row border-top">
                                        <div class="col-md-6 p-2">
                                            <label for="" class="form-label">Total Marks(Maximum - 100):</label>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <input type="number" name="total_marks" id="total_marks" value = "{{$assignment->total_points}}" class="form-control" max='100' min='0' required autocomplete='off'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 p-2">
                                            <label for="" class="form-label">Assign To:</label>
                                        </div>
                                        <div class="col-md-3 p-2">
                                            <input type="checkbox" name="all_members" id="assign_to_all" value="assign_to_all" checked>
                                            <label for="assign_to_all" class="form-label">All Members</label>
                                        </div>
                                    </div>
                                    <div class="form-group row border-top">
                                        <div class="col-md-6 p-2">
                                            <label for="assignment_start_date" class="form-label">Start Date:</label>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <input type="datetime-local" name="start_date" value="{{$assignment->start_date}}" id="assignment_start_date" class='form-control' required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 p-2">
                                            <label for="deadline" class="form-label">Submission Deadline:</label>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <input type="datetime-local" name="deadline" id="assignment_deadline" value="{{$assignment->end_date}}" onchange="checkDates()" class='form-control' required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 p-2">
                                            <label for="close_date" class="form-label">Close Date:</label>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <input type="datetime-local" name="close_date" id="assignment_close_date" value="{{$assignment->close_date}}" onchange="checkDates()" class='form-control' required>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button  class="btn btn-primary btn-sm" type='submit' form="edit-assignment{{$assignment->id}}">Save</button>
                        </div>
                        </div>
                    </div>
                </div>
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
                                        Submission Deadline: <span class="right">{{dateFormat($assignment->end_date,'D jS M Y')}} at {{dateFormat($assignment->end_date,'H:m')}}Hrs</span>
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
                        @if($assignment->close_date >= date('Y-m-d'))
                            @if(Auth::user()->assignment_submissions->where('assignment_id',$assignment->id)->count() == 0)
                            <!-- check if the assignment has not yet closed-->
                            <a href="{{route('assignment.attempt',[$subject->id,$assignment->id])}}" class="nav-link">
                                <button class="btn btn-primary btn-sm right">Attempt Assignment</button>
                            </a>
                            @else
                                <span class="right p-2 bg-success text-white mx-2"> View feedback</span>
                                <span class="right p-2 bg-info text-white"> Already submitted</span>
                            @endif
                        @else
                            <span class="right p-2 bg-danger text-white"> Assignment Closed</span>
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
                                @if($submitted->attachment_link)
                                @php $attach = json_decode($submitted->attachment_link)     @endphp
                                    @foreach($attach as $doc)
                                        <a href="{{route('viewSubmission',[$submitted->id,$doc])}}" class="nav-link" target=_blank><i class="fa fa-paperclip"></i> {{$doc}}</a>
                                    @endforeach
                                @else
                                    <span class='text-danger'><i>No attachment</i></span>
                                @endif
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
                                        <div class="p- mt-1">
                                            <i>{{$comment->comment}}</i> <br>
                                            <span class="text-muted">
                                                {{$comment->user->firstName}} {{$comment->user->lastName}}
                                                <span class="right">
                                                    {{dateFormat($comment->created_at,'jS M,  H:m')}} Hrs
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