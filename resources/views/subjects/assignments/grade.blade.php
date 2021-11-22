@Extends('layouts.subjectView')
@section('crumbs')
    {{Breadcrumbs::render('gradeAssignment',$subject,$assignment,$subject->id,$assignment->id)}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row p-2 bg-white mt-1">
            <div class="col p-1">
                <ul class="nav">                            
                    <li class="nav-item">
                        <span class="h5">
                            <a href="{{route('assignments',$assignment->subject->id)}}" class="nav-link p-2 border">{{$assignment->assignment_name}}</a>
                        </span>
                    </li>
                    <li class="nav-item mt-2">
                        <span class="mx-2 p-2 border">
                            <b>Total Marks:</b> X/{{$assignment->total_points}}
                        </span>
                    </li>
                    <li class="nav-item mt-2">
                        <span class="mx-2 p-2 border">
                            <b>Total submissions:</b> {{$assignment->assignment_submissions->count()}} out of {{$assignment->subject->users->count()}}
                        </span>
                    </li>
                    <li class="nav-item mt-2">
                        <span class="mx-2 mt-2 p-2 border">
                            <b>Graded:</b> <span class="graded"></span>
                        </span>
                    </li>
                    <li class="nav-item mt-2">
                        <span class="mx-2 p-2 border">
                            <select name="submitted_users" id="submission_list" class="custom-input" style='width:200px' onchange="fetchSubmittedAssignment({{$assignment->id}},$(this).val())">
                                <option value="" hidden>Select student</option>
                                    @foreach($submissions as $submitted)
                                        <option value="{{$submitted->user->id}}">{{$submitted->user->firstName}} {{$submitted->user->lastName}}</option>
                                    @endforeach
                            </select>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row p-1">
            <div class="col p-4 shadow bg-white assignment-displayed">
                <embed src="reagan.pdf"><embed>
            </div>
            <div class="col-md-2 p-2 border-left bg-white mx-1">
                <div class="header h4">Assignment Details</div>
                <label for="user-attachments" class="form-label"></label>
                <input type="hidden" name="submission_id" id='submission_id'>
                <select name="" id="user-attachments" class="custom-select" onchange="loadAttachment($(this).val())"></select>

        <!--add grades-->
                <div class="p-2">
                    <div class="header h4">Marks / Grades</div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="assigned_grade"  onblur="submitGrade($(this).val(),{{$assignment->total_points}},$('#submission_id').val())" style="width:60px" min='0'>
                        <label for="assigned_grade">/ {{$assignment->total_points}}</label>
                    </div>
                </div>
        <!--add comments-->
                <div class="p-2">
                    <div class="header h4">Comments</div>
                    <div class="p-2 submission-comments">
                        
                    </div>
                    <textarea type="text" class="form-control" id="assigned_comment"  cols='20' rows='3'></textarea>
                    <div class="p-1 row">
                        <div class="col p-2">
                            <button class="btn btn-sm btn-primary right" onclick="saveComment($('#assigned_comment').val(),$('#submission_id').val())">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection