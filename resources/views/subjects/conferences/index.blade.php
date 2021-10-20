@Extends('layouts.subjectView')
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
                                    <button class="btn btn-secondary btn-sm" data-toggle='modal' data-target='#new-conference'><i class="fa fa-plus"> Conference</i></button>
                                </span>
                                @endif
                            </h4>
                        </div>
                        <div id="collapsenew" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            @if(!empty($conferences))
                                @foreach($conferences as $conference)
                                        <div class="p-2 row">
                                            <div class="col p-1">
                                                {{$conference->conference_name}}
                                                <span class="right">
                                                    @if($conference->user == Auth::user())
                                                        <button class="btn btn-sm btn-primary">Start</button>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                @endforeach
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
                            <form action="{{route('newConference')}}" id="new-conference-form" method='POST'>
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
                                    <textarea type="text" name="conference_details" id="conference_details" class="form-control" required></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-sm" type='submit' form="new-conference-form">Save</button>
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
                                </span>
                            </h4>
                        </div>
                        <div id="collapseEnded" class="collapse show" aria-labelledby="headingEnded" data-parent="#accordionEnded">
                        <div class="card-body">
                            @if(!empty($conferences))
                                @foreach($conferences as $conference)
                                        <div class="p-2 row">
                                            <div class="col p-1">
                                                {{$conference->conference_name}}
                                                <span class="right">
                                                    @if($conference->user == Auth::user())
                                                        <button class="btn btn-sm btn-primary">Start</button>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                @endforeach
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection