@Extends('layouts.subjectView')
@include('includes.functions')
@section('crumbs')
    {{Breadcrumbs::render('subjectConferences',$subject,$subject->id)}}
@endsection
@section('subjectContent')
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col p-2">
                <h3 class="header">Conferences</h3>
            </div>
        </div>
        <div class="row p-1">
            <div class="col p-2">
<!-- new conferences-->
                <div class="accordion m-3" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h4 class="mb-0">
                                <span  data-toggle="collapse" data-target="#collapsenew" aria-expanded="true" aria-controls="collapseOne">
                                    NEW CONFERENCES
                                </span>
                                @if(Auth::user()->hasRole(['teacher']))
                                <span class="right">
                                    <button class="btn btn-sm btn-success" onclick="ShowDiv('conference-link')"><i class="fa fa-plus"> Conference</i></button>
                                    <!--<button class="btn btn-secondary btn-sm" data-toggle='modal' data-target='#new-conference'><i class="fa fa-plus"> Conference</i></button>-->
                                </span>
                                @endif
                            </h4>
                        </div>
                        <div id="collapsenew" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                    <!-- conference link-->
                    <div class="p-2 hidden conference-link">
                                <form action="{{route('newConference')}}" id="new-conference-form" method='POST'>
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                        <label for="conference_title" class="form-label">Title</label>
                                        <input type="text" name="conference_title" id="conference_title" value="{{$subject->subject_code}} - Conference" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="conference_duration" class="form-label hidden">Duration (minutes)</label>
                                        <input type="hidden" name="conference_duration" id="conference_duration" value='60' class="form-control">
                                    </div>
                                    <div class="form-group hidden">
                                        <input type="checkbox" name="unlimited_time" id="unlimited_time" value='unlimited'>
                                        <label for="unlimited_time" class="form-label">Unlimited Time</label>
                                    </div>
                                    <div class="form-group hidden">
                                        <input type="checkbox" name="enable_recording" id="conference_recording" value='True'>
                                        <label for="conference_recording" class="form-label">Enable Recording</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="conference_details" class="form-label">Description</label>
                                        <textarea type="text" name="conference_details" id="conference_details" class="form-control"></textarea>
                                    </div>
                                    <!--<div class="form-group">
                                        <label for="conference_link" class="form-label">Link</label>
                                        <input type="text" name="conference_link" id="conference_link"  class="form-control" placeholder="Paste link...">
                                    </div>-->
                                    <div class="form-group">
                                        <label for="conference_link" class="form-label">Add Link</label>
                                        <textarea type="text" name="conference_link" id="textarea"  class="form-control" placeholder="Paste link..."></textarea>
                                    </div>
                                    <div class="row p-1">
                                        <div class="col">
                                            <button  class="btn btn-primary btn-sm right" type='submit'>Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @if($upcoming->count() > 0 || $active->count() > 0)
                                @foreach($upcoming as $conference)
                                    <div class="row m-1 border">
                                        <div class="col p-2">
                                            <h5 onclick="startConference({{$conference->id}},'subject/{{$subject->id}}/conferences')">{!!$conference->conference_link!!} </h5>
                                            <span class="text-muted">
                                                {{$conference->description}}
                                            </span>
                                        </div>
                                        <div class="col-md-2 p-2 inline-block">
                                            <span class="right">
                                                @if(Auth::user()->owns($conference) || Auth::user()->hasRole(['administrator','superadministrator','school-administrator','ict-admin']))
                                                    <a href="#" class="nav-link" onclick="xdialog.confirm('Confirm to delete conference?',function(){deleteConference({{$conference->id}})})"><i class="fa fa-trash text-danger btn btn-sm btn-circle btn-light"></i></a>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach($active as $conference)
                                    <div class="row m-1 border">
                                        <div class="col p-2">
                                            <h5>{!!$conference->conference_link!!} </h5>
                                            <span class="text-muted">
                                                {{$conference->description}}
                                            </span>
                                        </div>
                                        <div class="col p-2">
                                            <!--progress bar-->
                                            <h5>In progress...</h5>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 40%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 p-2 inline-block">
                                            <span class="right">
                                            @if(Auth::user()->hasRole(['student','teacher','school-administrator']) && $conference->status =='Active')
                                                <!--<a target=_blank href="{{route('startConference')}}" class="nav-link" ><button class='btn btn-sm btn-outline-success' onclick="event.preventDefault(); document.getElementById('startConference-form{{$conference->id}}').submit();">Join</button></a>
                                                <form action="{{route('startConference')}}" id='startConference-form{{$conference->id}}' method='POST'>
                                                    @csrf
                                                    <input type="hidden" name="url_name" value="{{$conference->conference_link}}">
                                                </form>-->
                                            @endif
                                            @if(Auth::user()->owns($conference))
                                                @if($conference->status =='Active') <!-- checks if the conference is active and running-->
                                                    <a href="#" class="nav-link" onclick="xdialog.confirm('Confirm to end the conference?',function(){endConference({{$conference->id}})})"><button class='btn btn-sm btn-outline-danger'>End</button></a>
                                                @endif
                                            @endif
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="row m-1">
                                    <div class="col p-2 border">
                                        <h5>No new conferences</h5>
                                    </div>
                                </div>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="new-conference" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">{{$subject->subject_name}} New Conference</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="p-2">
                                <form action="{{route('newConference')}}" id="new-conference-form-modal" method='POST'>
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                        <label for="conference_title" class="form-label">Title</label>
                                        <input type="text" name="conference_title" id="conference_title" value="{{$subject->subject_code}} - Conference" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="conference_duration" class="form-label">Duration (minutes)</label>
                                        <input type="text" name="conference_duration" id="conference_duration" value='60' class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="unlimited_time" id="unlimited_time" value='unlimited'>
                                        <label for="unlimited_time" class="form-label">Unlimited Time</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="enable_recording" id="conference_recording" value='True'>
                                        <label for="conference_recording" class="form-label">Enable Recording</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="conference_details" class="form-label">Description</label>
                                        <textarea type="text" name="conference_details" id="conference_details" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="conference_link" class="form-label">Link</label>
                                        <input type="text" name="conference_link" id="conference_link"  class="form-control" placeholder="Paste link...">
                                    </div>
                                </form><!--https://demo.bigbluebutton.org/gl/ahi-tea-b0x-uvr-->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button  class="btn btn-primary btn-sm" type='submit' form="new-conference-form-modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>

<!--concluded conferences-->
                <div class="accordion m-3" id="accordionEnded">
                    <div class="card">
                        <div class="card-header" id="headingEnded">
                            <h4 class="mb-0">
                                <span  data-toggle="collapse" data-target="#collapseEnded" aria-expanded="true" aria-controls="collapseOne">
                                    CONCLUDED CONFERENCES
                                    @if($concluded)
                                        <span class="right">({{$concluded->count()}})</span>
                                    @endif
                                </span>
                            </h4>
                        </div>
                        <div id="collapseEnded" class="collapse show" aria-labelledby="headingEnded" data-parent="#accordionEnded">
                        <div class="card-body concluded-conferences">
                            @if($concluded->count() > 0)
                                @foreach($concluded as $conference)
                                        <div class="p-1 row conference m-1 ">
                                            <div class="col p-2">
                                                {!!$conference->conference_link!!}
                                                <span class="text-muted">
                                                    {{dateFormat($conference->created_at,'D jS M')}}, 
                                                    {{dateFormat($conference->updated_at,'H:i')}} Hrs
                                                </span>
                                            </div>
                                            @if($conference->conference_video_link)
                                            <div class="p-2 col-md-2 border-left">
                                                <a href="{{route('videoWatch',$conference->id)}}" class="nav-link">
                                                    <video src="" width='20px' height='20px' type='video/mp4'></video>
                                                </a>
                                            </div>
                                            @endif
                                            <div class="col-md-3 p-2 border-left">
                                                <span class="inline-block right">
                                                    @if(Auth::user()->hasRole(['teacher','school-administrator','administrator','superadministrator']) || Auth::user()->owns($conference))
                                                        <a href="#conference{{$conference->id}}" class="nav-link btn btn-sm btn-circle btn-light" @popper(Add Video) title='Add Video' data-toggle='modal'><i class="fa fa-video"></i></a>
                                                        <a href="#" class="nav-link btn btn-sm btn-circle btn-light" onclick="xdialog.confirm('Confirm to delete conference?',function(){deleteConference({{$conference->id}})})"><i class='fa fa-trash'></i> </a>
                                                    @endif
                                                </span>
                                                @if(!$conference->conference_video_link && Auth::user()->hasRole(['teacher']))
                                                    <span class="right p-2">
                                                        <i>No Video</i>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    <!--modal to add video to conference-->
                                        <div class="modal fade" id="conference{{$conference->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="modal-title text-dark h3" id="staticBackdropLabel">{!!$conference->conference_link!!}</div>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="p-2">
                                                            <form action="{{route('addVideo')}}" id="add-conference-video{{$conference->id}}" method='POST' enctype='multipart/form-data'>
                                                                @csrf
                                                                <div class="form-group">
                                                                    <input type="hidden" name="conference_id" value="{{$conference->id}}">
                                                                    <input type="hidden" name="subject_id" value="{{$conference->subject->id}}">
                                                                    <label for="conference_video">Add Video</label>
                                                                    <input type="file" name="conference_video" id="conference_video" class="form-control">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                        <button  class="btn btn-primary btn-sm" type='submit' form="add-conference-video{{$conference->id}}">Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                        
                                @endforeach
                            @else
                                <div class="row m-1">
                                    <div class="col p-2 border">
                                        <h5>No new conferences</h5>
                                    </div>
                                </div>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection