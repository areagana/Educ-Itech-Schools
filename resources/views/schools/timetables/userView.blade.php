@Extends('layouts.users')
@section('crumbs')

@endsection
@section('content')
    <div class="container">
        <div class="header h4">Time Tables</div>
        <div class="row p-2">
            <div class="col p-2">
            <!-- check if the class has timetables-->
                @if(Auth::user()->hasRole(['student']))
                    @php
                        $form = Auth::user()->forms->first();
                    @endphp 
                    
                @endif
                @if($form->timetables()->where('term_id',$term->id)->count() > 0)
                    @foreach($form->timetables as $table)
                        <div class="p-2 time-table bg-white shadow-sm mt-1">
                            {{$table->title}} 
                            <span class="right inline-block">
                                <a href="{{route('DownloadTimetable',$table->id)}}" class="nav-link btn btn-outline-danger btn-sm"><i class="fa fa-download"> Download</i></a>
                                <a href="{{route('viewTimetable',$table->id)}}" class="nav-link btn btn-outline-primary btn-sm" target=_blank ><i class="fa fa-eye"> View</i></a>
                            </span> <br>
                            <span class="text-muted">
                                {{$table->form->form_name}}
                            </span>
                        </div>
                    @endforeach
                    <!--display other genereal timetables if class timetables are found-->
                    @if($termTimetables)
                        @foreach($termTimetables as $ttable)
                            @if(!$ttable->form()->exists())<!-- checks if the relationship does not have data to avoid repetitions-->
                                <div class="p-2 bg-white time-table shadow-sm mt-1">
                                    {{$ttable->title}}
                                    <span class="right inline-block">
                                        <a href="{{route('DownloadTimetable',$ttable->id)}}" class="nav-link btn btn-outline-danger btn-sm"><i class="fa fa-download"> Download</i></a>
                                        <a href="{{route('viewTimetable',$ttable->id)}}" class="nav-link btn btn-outline-primary btn-sm" target=_blank ><i class="fa fa-eye"> View</i></a>
                                    </span> <br>
                                    <span class="text-muted">
                                        {{__('All classes')}}
                                    </span>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @elseif($termTimetables)
                    @foreach($termTimetables as $ttable)
                    <div class="p-2 bg-white time-table shadow-sm mt-1">
                        {{$ttable->title}}
                        <span class="right inline-block">
                            <a href="{{route('DownloadTimetable',$ttable->id)}}" class="nav-link btn btn-outline-danger btn-sm"><i class="fa fa-download"> Download</i></a>
                            <a href="{{route('viewTimetable',$ttable->id)}}" class="nav-link btn btn-outline-primary btn-sm" target=_blank ><i class="fa fa-eye"> View</i></a>
                        </span> <br>
                        <span class="text-muted">
                            {{__('All classes')}}
                        </span>
                    </div>
                    @endforeach
                    
                @else
                    <div class="p-2 bg-white time-table">
                        <span class="h4">No timetables to show</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection