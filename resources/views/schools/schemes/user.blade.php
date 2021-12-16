@Extends('layouts.subjectview')
@include('includes.functions')
@section('crumbs')

@endsection
@section('subjectContent')
    <div class="row p-2">
        <div class="col p-2 bg-white">
            <div class="header h3">{{$subject->subject_name}} Schemes of Work
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col p-2 ">
            @if($currentschemes->count() > 0)
                @foreach($currentschemes as $key=> $scheme)
                    <div class="p-2 mt-1 bg-white scheme-previous shadow-sm"> 
                        <span class="h4">{{$scheme->scheme_title}} </span><span class="right text-muted">{{$scheme->term->term_name}}</span> <br>
                        <div class="p-2 row">
                            <div class="col p-2">
                                <span class="text-muted">
                                    Uploaded on {{dateFormat($scheme->created_at,'D jS M Y')}}
                                </span>
                                <span class="justify-content-center inline-block border-top right">
                                    <a href="{{route('viewScheme',$scheme->id)}}" class="nav-link btn btn-outline-primary btn-sm" target=_blank><i class="fa fa-eye"></i></a>
                                    <a href="{{route('DownloadScheme',$scheme->id)}}" class="nav-link btn btn-outline-primary btn-sm"><i class="fa fa-download"></i></a>
                                    @if(Auth::user()->owns($scheme))
                                        <a href="#" class="nav-link btn btn-outline-primary btn-sm" onclick="xdialog.confirm('Confirm to delete {{$scheme->scheme_title}}?',function(){deleteItem({{$scheme->id}},'/scheme/delete')})"><i class="fa fa-trash"></i></a>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
        <!--if no schemes for the current term are available-->
                <div class="p-2">
                    <div class="header h4">Schemes</div>
                    <div class="p-2 scheme-previous shadow-sm mt-1">
                        <p>As a teacher, you are required to upload your schemes for quality assurance of the teaching content</p>
                        <p>All your schemes will be displayed here after upload and will be accessed by the people responsible.</p>
                    </div>
                    <div class="p-2 scheme-previous shadow-sm mt-1">
                        <div class="header h6">Advantages</div>
                        <li>You can access your schemes any time.</li>
                        <li>Self monitoring and assessment is done faster</li>
                        <li>No time wasting in repeating schemes if the same content is to be taught.</li>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-3 ml-1">
            <div class="header h5 bg-white">Upload pdf Document</div>
            @if($term)
            <div class="p-2 bg-white shadow-sm">
                <form action="{{route('storeSchemes')}}" method='POST' id='timetable-upload-form' enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="school_id" value='{{$school->id}}'>
                        <input type="hidden" name="term_id" value='{{$term->id}}'>
                        <input type="hidden" name="school_forms" value='{{$subject->form->id}}'>
                        <input type="hidden" name="form_subjects" value='{{$subject->id}}'>
                        <label for="scheme_title" class="form-label">Title</label>
                        <input type="text" class="form-control form-control-sm" name='scheme_title' id='timetable_title' placeholder="Title..." required>
                    </div>
                    <div class="form-group">
                        <label for="timetable"><i class="fa fa-paperclip"></i> File</label>
                        <input type="file" name="scheme" id="timetable" class='form-control form-control-sm' required>
                        @if ($errors->has('file'))
                            <span class="errormsg text-danger">{{ $errors->first('scheme') }}</span>
                        @endif
                    </div>
                </form>
                <div class="row p-1">
                    <div class="col p-2">
                        <button class="btn btn-sm btn-primary right" form='timetable-upload-form'><i class="fa fa-share"></i> Submit</button>
                    </div>
                </div>
            </div>
            @endif
            <div class="header bg-white mt-2 h4">Previous schemes</div>
            <div class="header bg-white mt-2 h4"><input type="text" class="form-control form-control-sm" id = 'find_previous' onkeyup="SearchItemClass('find_previous','previous-schemes','scheme-previous')" placeholder='Search...'></div>
            <div class="p-2" id='previous-schemes'>
                @if($allschemes->count() > 0)
                    @foreach($allschemes as $previous)
                    
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