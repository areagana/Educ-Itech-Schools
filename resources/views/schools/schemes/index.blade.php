@Extends('layouts.schoolHome')
@include('includes.functions')
@section('crumbs')

@endsection
@section('schoolContent')
    <div class="row p-2">
        <div class="col p-2 bg-white">
            <div class="header h3">Schemes of Work
                <span class="right inline-block h6">
                    <a href="" class="nav-link btn btn-sm btn-outline-success"><i class="fa fa-upload"></i> Upload</a>
                    <a href="" class="nav-link btn btn-sm btn-outline-info"><i class="fa fa-eye"></i> Review</a>
                    <a href="" class="nav-link btn btn-sm btn-outline-primary"><i class="fa fa-print"></i> Print</a>
                </span>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col p-2 bg-white ">
            <table class="table table-sm table-hover">
                <thead class="table-info">
                    <tr>
                        <th colspan='7'><span class="text-align-center">{{$term->term_name}} {{$term->term_year}} Schemes of work</span></th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Course</th>
                        <th>Class</th>
                        <th>Title</th>
                        <th>Attachment</th>
                        <th>D.O.Upload</th>
                        <th>More</th>
                    </tr>
                </thead>
                <tbody id='school-schemes'>
                    @if($currentschemes->count() > 0)
                        @foreach($currentschemes as $key=> $scheme)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$scheme->subject->course->course_name}}</td>
                                <td>{{$scheme->form->form_name}}</td>
                                <td>{{$scheme->scheme_title}}</td>
                                <td>{{$scheme->scheme_attachment}}</td>
                                <td>{{dateFormat($scheme->created_at,'D jS M y')}}</td>
                                <td>
                                    <span class="justify-content-center inline-block">
                                        <a href="{{route('viewScheme',$scheme->id)}}" class="nav-link btn btn-outline-primary btn-sm" target=_blank><i class="fa fa-eye"></i></a>
                                        <a href="{{route('DownloadScheme',$scheme->id)}}" class="nav-link btn btn-outline-primary btn-sm"><i class="fa fa-download"></i></a>
                                        <a href="#" class="nav-link btn btn-outline-primary btn-sm" onclick="xdialog.confirm('Confirm to delete {{$scheme->scheme_title}}?',function(){deleteItem({{$scheme->id}},'/scheme/delete')})"><i class="fa fa-trash"></i></a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan='7'><span class='h5'><center><i>No schemes Uploaded for this term</i></center></span></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-3 ml-1">
            <div class="header h5 bg-white">Upload pdf Document</div>
            <div class="p-2 bg-white shadow-sm">
                <form action="{{route('storeSchemes')}}" method='POST' id='timetable-upload-form' enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="school_id" value='{{$school->id}}'>
                        <input type="hidden" name="term_id" value='{{$term->id}}'>
                        <label for="timetable_title" class="form-label">Title</label>
                        <input type="text" class="form-control form-control-sm" name='scheme_title' id='timetable_title' placeholder="Title..." required>
                    </div>
                    <div class="form-group">
                        <div class="header h6">Class</div>
                        <select name="school_forms" id="school_forms_schemes" class="custom-select custom-select-sm" onchange="loadSubjects($(this).val(),'form_subjects')"required>
                            <option value="" hidden>Select</option>
                            @foreach($school->forms as $form)
                                <option value="{{$form->id}}">{{$form->form_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="header h6">Subject</div>
                        <select name="form_subjects" id="form_subjects" class="custom-select custom-select-sm" required>
                            <option value="" hidden>Select class first</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="timetable"><i class="fa fa-paperclip"></i> File</label>
                        <input type="file" name="scheme" id="timetable" class='form-control form-control-sm' required>
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
            </div>
            <div class="header bg-white mt-2 h4">Previous schemes</div>
            <div class="header bg-white mt-2 h4"><input type="text" class="form-control form-control-sm" id = 'find_previous' onkeyup="SearchItemClass('find_previous','previous-schemes','scheme-previous')" placeholder='Search...'></div>
            <div class="p-2" id='previous-schemes'>
                @if($allSchemes->count() > 0)
                
                    @foreach($allSchemes as $previous)
                    
                        <div class="p-2 mt-1 bg-white scheme-previous shadow-sm"> 
                            {{$previous->scheme_title}} <span class="right text-muted">{{$previous->term->term_name}}</span> <br>
                            <span class="text-muted">{{$previous->form->form_name}} ({{$previous->subject->subject_name}})
                                <span class="right"><a href="{{route('DownloadScheme',$previous->id)}}" class="nav-link" title='download'><i class="fa fa-download"></i></a></span>
                            </span>
                        </div>
                    @endforeach
                @else
                    <div class="p-2 mt-1 bg-white scheme-previous shadow-sm"> 
                        <span class="h5"><center><i>No Previous Schemes found</i></center></span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection