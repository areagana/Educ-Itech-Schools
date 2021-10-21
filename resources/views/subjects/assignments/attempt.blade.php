@Extends('layouts.subjectView')
@section('crumbs')
    {{Breadcrumbs::render('assignment.show',$subject,$assignment,$subject->id,$assignment->id)}}
@endsection
@section('subjectContent')
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-md-9 p-2 bg-white">
                <h3 class='header'>{{$assignment->assignment_name}}</h3>
                    <div class="p-1  border border-primary">
                        <div class="header h5">Upload Document (<i>First attach all documents before uploading</i>)
                            <span class="right attach-document h6 nav-link" onclick="AddFileAttach()" title='Add Attachment' @popper(Add Attachment)><i class="fa fa-plus"></i> Attachment</span>
                        </div>
                        <div class="p-2">
                            <form action="{{route('storeSubmission')}}" id="assignment-attachment-form" enctype='multipart/form-data' method='POST'>
                                @csrf
                        <!--hidden values-->
                                <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                <input type="hidden" name="assignment_id" value="{{$assignment->id}}">
                        <!-- files attachment-->
                                <div class="form-group add-attachment">
                                    <input type="file" name="assignment_attachment[]" class='form-control'>
                                </div>
                                <div class="row p-2">
                                    <div class="col p-1">
                                        <button class="btn btn-primary btn-sm right" type='submit'><i class="fa fa-upload"></i> Upload & Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
            <div class="col p-2 mx-1 bg-white">
                <h4 class="border-bottom p-2">To Do</h4>
            </div>
        </div>
    </div>
@endsection