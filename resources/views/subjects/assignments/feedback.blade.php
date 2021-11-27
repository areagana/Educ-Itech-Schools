@Extends('layouts.subjectView')
@section('crumbs')
    {{Breadcrumbs::render('assignment.show',$subject,$assignment,$subject->id,$assignment->id)}}
@endsection
@include('includes.functions')
@section('subjectContent')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2">
                <div class="header h4">{{$assignment->assignment_name}}</div>
                <div class="h6">Submitted Work</div>
                <div class="p-2 mt-2">
                    @foreach($attachments as $attachment)
                        <a href="{{route('viewSubmission',[$submission->id,$attachment])}}" class="nav-link" target=_blank>
                            {{$attachment}}
                        </a>
                    @endforeach
                </div>

                <h5 class="header h6">Teacher's Feedback</h5>
                <div class="p-2">
                    @if( is_array($feedbacks) && count($feedbacks) > 0)
                        @foreach($feedbacks as $feedback)
                            <a href="{{route('ViewFeedback',[$submission->id,$feedback])}}" class="nav-link" target=_blank>
                                {{$feedback}}
                            </a>
                        @endforeach 
                    @else
                        <div class="p-2">
                            <i>No feedback attachments from teacher</i>
                        </div>
                    @endif
                </div>
            </div>
            @if($submission->submission_comments->count() > 0)
            <div class="col-md-4">
                <h5 class="header"><i class="fa fa-comment"></i><i>Comments</i>
                    <span class="badge-danger px-1 h6 rounded-circle right">{{$submission->submission_comments->count()}}</span>
                </h5>
                <div class="p-2" id="comments-fetched">
                    @foreach($submission->submission_comments as $comment)
                        <div class="p-2" id='assignment-feedbacks'>
                            {{$comment->comment}} 
                            @if(Auth::user()->owns($comment))
                                <span class="right btn-outline-danger px-2" onclick="xdialog.confirm('Confirm to delete this comment?',function(){deleteComment({{$comment->id}})})">&times;</span>
                            @endif<br>
                            <span class="text-muted">
                                {{$comment->user->firstName}} {{$comment->user->lastName}}
                                <span class="right">
                                    {{dateFormat($comment->created_at,'jS M, H:i')}} Hrs
                                </span>
                            </span>
                        </div>
                    @endforeach
                </div>
                <div class="p-2">
                   <spam class="right text-info reply" onclick="ShowDiv('comment-reply')"><i class="fa fa-reply "></i> Reply</spam>
                   <span class="hidden p-2 comment-reply">
                       <textarea type="text" id="feed_back_comment" class="form-control" placeholder='Type...' onblur="saveComment($(this).val(),{{$submission->id}})"></textarea>
                   </span>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection