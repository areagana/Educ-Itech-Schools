@Extends('layouts.subjectView')
@section('crumbs')
    {{Breadcrumbs::render('subject',$subject,Auth::user()->school,Auth::user()->school->id)}}
@endsection
@section('subjectContent')
    <div class="row mx-1">
        <div class="col p-2 bg-white">
            <div class='p-2 subject-card-home bg-white'>
                <h4 class='header'>To-Do</h4>
                @foreach($upcoming as $event)
                    <div class="p-2 border-light">
                        {{dd($upcoming)}}
                    </div>
                @endforeach
            </div>
            <div class='p-2 subject-card-home'>
                <h4 class='header'>Recent Activity</h4>
                @foreach($previous as $event)
                    <div class="p-2 border border-light m-1">
                        {{$event->assignment_name}}
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-2 p-2 bg-white ml-1">
            <div class='header h5'>Upcoming ...</div>
                <div class='p-2'>
                @if($upcoming !='')
                    @foreach($upcoming as $event)
                        <div class="p-2 border border-light">
                            {{$event->assignment_name}}
                        </div>
                    @endforeach
                @else
                    <div class="p-2">
                        No upcoming events
                    </div>
                @endif
                </div>
            <div class='header h5'>Past Events</div>
                    <div class='p-2'>
                    @if($previous !='')
                        @foreach($previous as $event)
                            <div class="p-2">
                                {{$event->assignment_name}}
                            </div>
                        @endforeach
                    @else
                        <div class="p-2">
                            No ended events
                        </div>
                    @endif
                </div>
        </div>
    </div>
@endsection