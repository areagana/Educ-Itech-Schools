@Extends('layouts.schoolHome')
@include('includes.functions')
@section('crumbs')

@endsection
@section('schoolContent')
    <div class="container-fluid">
        <div class="h3 header">Announcements</div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#notices" data-toggle='tab'>Announcements</a>
                </li>
                <li class="nav-item">
                    <a href="#created-ann" class="nav-link" data-toggle='tab'><i class="fa fa-plus"></i> Create</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="notices">
                    @if($notices->count() > 0)
                        @foreach($notices as $notice)
                            <div class="notice-card shadow-sm bg-white mt-2">
                                <div class="header p-2 h5">
                                    {{$notice->announcement_title}}
                                    <span class="right inline-block">
                                        <a href="#" class="nav-link"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="nav-link"><i class="fa fa-trash" onclick="xdialog.confirm('Confirm to delete this announcement?',function(){deleteItem({{$notice->id}},'/ann/delete')})"></i></a>
                                    </span>
                                </div>
                                <div class="p-2">
                                    {!! $notice->announcement_content !!}
                                </div>
                                @if($notice->announcement_attachment)
                                    <div class="p-2 ">
                                        <a href="{{route('announcement.download',$notice->id)}}" class="nav-link">{{$notice->announcement_attachment}}</a>
                                    </div>
                                @endif
                                <div class="p-2 mb-2">
                                    <span class="text-muted">{{dateFormat($notice->created_at,'D jS M Y')}}</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="p-2 m-4">
                            <h4><i>No Annoucements Created</i></h4>
                        </div>
                    @endif
                </div>

            <!-- create new announcements-->
                <div class="tab-pane p-4 bg-white" id="created-ann">
                    <form action="{{route('announcement.store')}}" method='POST' enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="school_id" value='{{$school->id}}'>
                            <label for="announcement_title" class="form-label">Announcement Title</label>
                            <input type="text" class="form-control" name='announcement_title'  id='announcement_title' placeholder='Title...' autocomplete='off'>
                        </div>
                        <div class="form-group">
                            <label for="textarea" class="form-label">Message</label>
                            <textarea type="text" class="form-control" name='announcement_message'  id='textarea' placeholder='Title...'></textarea>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-paperclip btn btn-sm btn-light" onclick="ShowDiv('ann-attachment')"> Attach file</i> <br>
                            <div class="ann-attachment mt-2 hidden">
                                <input type="file" name="announcement_attachment" id="attachment" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="start_date">Start Date</label>
                                    <input type="datetime-local" name="start_date" id="start_date" class='form-control' onchange="checkDate($(this).val(),$('#end_date').val())">
                                </div>
                                <div class="col">
                                    <label for="start_date">End Date</label>
                                    <input type="datetime-local" name="end_date" id="end_date" class='form-control' onchange="checkDate($('#start_date').val(),$(this).val())">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="user-categories" class="form-label header h5 ">Who should see this?</label>
                            @foreach($roles as $level)
                                @if($level->name !='superadministrator' && $level->name !='user' )
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" name='school_level[]' id='school_level{{$level->id}}' value="{{$level->name}}">
                                    <label for="school_level{{$level->id}}" class="form-check-label">{{$level->display_name}}</label>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="form-row">
                            <div class="col p-2">
                                <button class="btn btn-primary right" type='submit'>Save Announcement</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection