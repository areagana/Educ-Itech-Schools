@Extends('subjects.view')
@section('crumbs')
    {{Breadcrumbs::render('assignments',$subject,$school->id)}}
@endsection
@section('subjectContent')
    <div class="container-fluid">
        
        <div class="row p-2">
            <div class="col p-2">
                <div class="h4 border-bottom">Assignments</div>
            </div>
        </div>
        <div class="row p-2">
            <div class="col p-2">
                <form action="{{route('storeAssignment')}}" id="new-assignment" method='POST'>
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="subject_id" value="{{$subject->id}}">
                        <label for="assignment_title" class="form-label">Assignment Title</label>
                        <input type="text" name="assignment_title" id="assignment_title" class="form-control" required autocomplete='off' placeholder='title'>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Assignment Content</label>
                        <textarea type="text" name="assignment_content" id="assignment_content" class="form-control" required autocomplete='off'></textarea>
                    </div>
                    <div class="form-group row">
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
                    <div class="form-group row">
                        <div class="col-md-6 p-2">
                            <label for="start_date" class="form-label">Start Date:</label>
                        </div>
                        <div class="col-md-3 p-2">
                            <input type="datetime-local" name="start_date" id="start_date" class='form-control'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 p-2">
                            <label for="deadline" class="form-label">Submission Deadline:</label>
                        </div>
                        <div class="col-md-3 p-2">
                            <input type="datetime-local" name="deadline" id="deadline" class='form-control'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 p-2">
                            <label for="close_date" class="form-label">Close Date:</label>
                        </div>
                        <div class="col-md-3 p-2">
                            <input type="datetime-local" name="close_date" id="close_date" class='form-control'>
                        </div>
                    </div>
                    <div class="form-group p-2 row">
                        <div class="col p-2">
                            <button class="btn btn-danger">Cancel</button>
                            <button class="btn btn-primary right" type='submit'>Save Assignment</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3 p-2">
                <div class="h5 border-bottom">Upcoming</div>
            </div>
        </div>
    </div>
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('assignment_content' );
    </script>
@endsection