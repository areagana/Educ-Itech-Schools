@Extends('schools.details')
@section('crumbs')

@endsection
@section('schoolContent')
    <div class="row p-2">
        <div class="col p-2">
            <div class="header h3">Time tables</div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col p-2">
            <div class="p-2 border border-primary">
                @foreach($timetables as $ttable)
                    <div class="p-3 time-table bg-white shadow-sm mt-1">
                        <h5>{{$ttable->title}}
                            <span class="right inline-block h6">
                                <a href="{{route('DownloadTimetable',$ttable->id)}}" class="nav-link btn btn-outline-danger btn-sm"><i class="fa fa-download"> Download</i></a>
                                <a href="{{route('viewTimetable',$ttable->id)}}" class="nav-link btn btn-outline-primary btn-sm" target=_blank ><i class="fa fa-eye"> View</i></a>
                                <a href="#" class="nav-link btn btn-outline-primary btn-sm" onclick="xdialog.confirm('Confirm to delete {{$ttable->title}}?',function(){deleteItem({{$ttable->id}},'/timetable/delete')})"><i class="fa fa-trash"></i></a>
                            </span>
                        </h5>
                        @if($ttable->form)
                        <span class="text-muted">{{$ttable->form->form_name}}</span>
                        @else
                            <span class="text-muted">All Classes</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4 p-2 border-left">
            <div class="header h5">Upload pdf Document</div>
            <div class="p-2 border border-primary bg-white">
                <form action="{{route('storeTimetables')}}" method='POST' id='timetable-upload-form' enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="school_id" value='{{$school->id}}'>
                        @if($term)
                        <input type="hidden" name="term_id" value='{{$term->id}}'>
                        @endif
                        <label for="timetable_title" class="form-label">Title</label>
                        <input type="text" class="form-control form-control-sm" name='timetable_title' id='timetable_title' placeholder="Title...">
                    </div>
                    <div class="form-group">
                        <div class="header h6">Duration (Optional)</div>
                        <label for="start_date" class="form-label">start Date
                            <input type="date" name="start_date" id="start_date" class="form-control form-control-sm">
                        </label>
                        <label for="end_date" class="form-label">End Date
                            <input type="date" name="end_date" id="end_date" class="form-control form-control-sm">
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="header h6">Class (Optional)</div>
                        <select name="school_forms" id="class_select" class="custom-select custom-select-sm">
                            <option value="All">All</option>
                            <option value="General">General</option>
                            @foreach($school->forms as $form)
                                <option value="{{$form->id}}">{{$form->form_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="timetable"><i class="fa fa-paperclip"></i> File</label>
                        <input type="file" name="file[]" id="timetable" class='form-control form-control-sm'>
                        @if ($errors->has('file'))
                            <span class="errormsg text-danger">{{ $errors->first('file') }}</span>
                        @endif
                    </div>
                </form>
                <div class="row p-1">
                        <div class="col p-2">
                            <button class="btn btn-sm btn-primary right" form='timetable-upload-form'><i class="fa fa-share"></i> Submit</button>
                        </div>
                </div>
                <div class="row p-1">
                    <div class="col p-2">
                        <button class="btn btn-block btn-primary" onclick="addAttachment('timetable-upload-form')"><i class="fa fa-plus-circle"></i> Add attachment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection