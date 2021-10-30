@Extends('layouts.subjectView')
@include('includes.functions')
@section('crumbs')
    {{Breadcrumbs::render('subjectNotes',$subject,$subject->id)}}
@endsection
@section('subjectContent')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2 bg-white shadow-sm">
                <h4>{{$subject->subject_name}} Modules / Notes </h4>
            </div>
            <div class="col-md-2 p-2 bg-white shadow-sm">
                <span class="right p-2 bg-info h6" @popper(Create Module)><a class='nav-link text-white' href="{{route('module',$subject->id)}}"><i class="fa fa-plus"></i> Module</a></span>
            </div>
        </div>
        <div class="row p-1">
            <div class="col p-2 bg-white shadow-sm mx-1">
                @foreach($modules as $module)
                <div class="accordion m-3 shadow-sm" id="accordion{{$module->id}}">
                    <div class="card">
                        <div class="card-header" id="heading{{$module->id}}">
                            <h4 class="mb-0">
                                <span class='module-header' data-toggle="collapse" data-target="#collapse{{$module->id}}" aria-expanded="true" aria-controls="collapse{{$module->id}}">
                                    {{$module->module_name}}
                                </span>
                                <span class="right">
                                    <div class="dropdown">
                                        @if(Auth::user()->hasRole(['teacher','administrator','superadministrator','ict-admin','school-administrator']))
                                            <button class="btn btn-light dropdown-toggle border border-primary" id="addModuleContent" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-plus m-1"></i></button>
                                            <button class="btn btn-light border border-primary btn-outline-primary" onclick="xdialog.confirm('Do you confirm to delete {{$module->module_name}}? <br> Please note that all the notes with in will be deleted!!',function(){deleteItem('{{$module->id}}','/module/delete')})" @popper(Delete Module)><i class="fa fa-trash"></i></button>
                                        @endif
                                        <button class="btn btn-light" onclick="ShowMore('moreModule{{$module->id}}')"><i class="fa fa-ellipsis-v"></i></button>
                                            <ul class="dropdown-menu text-small shadow p-2" aria-labelledby="addModuleContent">
                                                <li><a class="dropdown-item" href="#" data-toggle='modal' data-target='#notesModule{{$module->id}}'>Text Content</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="ShowDiv('uploadNotes{{$module->id}}')"><i class="fa fa-upload"></i> Upload </a></li>
                                            </ul>
                                    <!--more toggle-->
                                            <div class="more absolute shadow p-2" id='moreModule{{$module->id}}'>
                                                <a href="#" class="nav-link" id='primary' onclick="ModuleColor($(this).attr('id'),{{$module->id}})">Blue</a>
                                                <a href="#" class="nav-link" id='success' onclick="ModuleColor($(this).attr('id'),{{$module->id}})">Green</a>
                                                <a href="#" class="nav-link" id='purple' onclick="ModuleColor($(this).attr('id'),{{$module->id}})">Purple</a>
                                            </div>
                                        </div>
                            <!-- Modal -->
                                    <div class="modal fade" id="notesModule{{$module->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">{{$module->module_name}} Text Notes</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="p-2">
                                                        <form action="{{route('NoteStore')}}" id="moduleContent{{$module->id}}" method='POST'>
                                                            @csrf
                                                            <div class="form-group">
                                                                <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                                                <input type="hidden" name="module_id" value="{{$module->id}}">
                                                                <label for="note_title" class="form-label">Note Title</label>
                                                                <input type="text" name="note_title" id="note_title" class="form-control" placeholder='Title...' required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="textarea" class="form-label">Content</label>
                                                                <textarea type="text" name="note_content" id="textarea{{$module->id}}" class="form-control" required></textarea>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary btn-sm" type='submit' form="moduleContent{{$module->id}}">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <!-- end modal-->
                                </span>
                            </h4>
                        </div>
                        <div id="collapse{{$module->id}}" class="collapse show" aria-labelledby="heading{{$module->id}}" data-parent="#accordion{{$module->id}}">
                        <div class="card-body">
                            <div class="p-2 uploadNotes{{$module->id}} hidden shadow note-card note-card-{{$module->background_color}}">
                                <h5 class="header"><b>Upload Module Notes</b></h5>
                                <form action="{{route('NoteStore')}}" id="module-upload{{$module->id}}" method='POST' enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                        <input type="hidden" name="module_id" value="{{$module->id}}">

                                        <label for="document_title" class="form-label">Document Title</label>
                                        <input type="text" name ='note_title' class="form-control" id="document_title" placeholder='Type title...' autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="document_file" class="form-label">Attachment</label>
                                        <input type="file" name ='file' class="form-control" id="document_file" required>
                                    </div>
                                </form>
                                    <div class="row p-2">
                                        <div class="col p-2">
                                            <button class="btn btn-sm btn-danger" onclick="Close('uploadNotes{{$module->id}}')">Cancel</button>
                                            <button class="btn btn-sm btn-primary right" type='submit' form="module-upload{{$module->id}}">Upload</button>
                                        </div>
                                    </div>
                            </div>
                            @if($module->notes->count()>0)
                                @foreach($module->notes as $note)
                                    <div class="note-card note-card-{{$module->background_color}} mt-1 row p-2 mx-1">
                                        <div class="p-2 col">
                                            @if($note->attachment_name !='')
                                                {{$note->note_title}}
                                                    <span class="right">
                                                        <i class="fa fa-paperclip btn btn-sm btn-light" @popper(Attachment) title='Attachment'></i>
                                                    </span><br>
                                            @else
                                                {{$note->note_title}} <br>
                                            @endif
                                            <div class="text-muted">
                                                Created: {{dateFormat($note->created_at,'jS M Y')}}
                                            </div>
                                        </div>
                                        <div class="col-md-2 p-2 border-left  inline-block">
                                            @if($note->attachment_name !='')
                                                <a href="{{route('downloadNotes',$note->id)}}" class="btn btn-sm btn-{{$module->background_color}}" @popper(Download) title='Download'>
                                                    <i class="fa fa-download"></i>
                                                </a >
                                                <a href="{{route('openNotes',$note->id)}}" class="btn btn-sm btn-{{$module->background_color}}" @popper(View) title='View' target=_blank>
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @else
                                                <a href="{{route('noteView',$note->id)}}" class="btn btn-sm btn-{{$module->background_color}}" @popper(View) title='View'>
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endif
                                            @if(Auth::user()->hasRole(['teacher','school-administrator','ict-admin']))
                                                <a href="#" class="btn btn-sm btn-{{$module->background_color}}" @popper(View) title='Delete' 
                                                    onclick="xdialog.confirm('Confirm to delete this note?',function(){deleteItem({{$note->id}},'/note/delete')})"><i class="fa fa-trash"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="p-3 border border-light">
                                    No notes added
                                </div>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @if(isset($newmodule) AND $newmodule =='Create')
                <div class="accordion m-3" id="accordionNewModule">
                    <div class="card">
                        <div class="card-header" id="headingNewModule">
                            <h4 class="mb-0">
                                <form action="{{route('moduleStore',$subject->id)}}" id="new-module-form" method='POST'>
                                    @csrf
                                    <span  data-toggle="collapse" data-target="#collapseNewModule" aria-expanded="true" aria-controls="collapseNewModule">
                                        <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                        <div class="form-group">
                                            <input type="text" name='module_name' class="form-control" placeholder='Module name...' autofocus required>
                                            <div class="row p-1">
                                                <div class="col p-2">
                                                    <button class="btn btn-sm btn-secondary " type='submit'>Cancel</button>
                                                    <button class="btn btn-sm btn-secondary right" type='submit'>Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </span>
                                </form>
                            </h4>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection