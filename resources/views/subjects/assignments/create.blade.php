@Extends('layouts.subjectView')
@section('crumbs')
    {{Breadcrumbs::render('CreateAssignments',$subject,$school->id)}}
@endsection
@section('subjectContent')
    <div class="container-fluid">
        
        <div class="row p-2 bg-white mx-0">
            <div class="col p-2">
                <div class="h4 border-bottom">Assignments</div>
            </div>
        </div>
        <div class="row p-3">
            <div class="col p-3 bg-white">
                <form action="{{route('storeAssignment')}}" id="new-assignment" method='POST' enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="subject_id" value="{{$subject->id}}">
                        <label for="assignment_title" class="form-label">Assignment Title</label>
                        <input type="text" name="assignment_title" id="assignment_title" class="form-control" required autocomplete='off' placeholder='Title...'>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Assignment Content</label>
                        <textarea type="text" name="assignment_content" id="assignment_content" class="form-control" required autocomplete='off'></textarea>
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
                            <input type="number" name="total_marks" id="total_marks" class="form-control" max='100' min='0' required autocomplete='off'>
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
                            <label for="start_date" class="form-label">Start Date:</label>
                        </div>
                        <div class="col-md-6 p-2">
                            <input type="datetime-local" name="start_date" id="start_date" class='form-control'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 p-2">
                            <label for="deadline" class="form-label">Submission Deadline:</label>
                        </div>
                        <div class="col-md-6 p-2">
                            <input type="datetime-local" name="deadline" id="deadline" class='form-control'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 p-2">
                            <label for="close_date" class="form-label">Close Date:</label>
                        </div>
                        <div class="col-md-6 p-2">
                            <input type="datetime-local" name="close_date" id="close_date" class='form-control'>
                        </div>
                    </div>
                    <div class="form-group p-2 row border-top">
                        <div class="col p-2">
                            <button class="btn btn-danger">Cancel</button>
                            <button class="btn btn-primary right" type='submit'>Save Assignment</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3 p-2 bg-white ml-2">
                <div class="h5 border-bottom">Upcoming</div>
            </div>
        </div>
    </div>
@endsection