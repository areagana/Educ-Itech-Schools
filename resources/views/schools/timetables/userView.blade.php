@Extends('layouts.users')
@include('includes.functions')
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
                @if($current->count() > 0)
                    @foreach($current as $table)
                        <div class="p-2 time-table bg-white shadow-sm mt-1">
                            {{$table->title}} 
                            <span class="right inline-block">
                                <a href="{{route('DownloadTimetable',$table->id)}}" class="nav-link btn btn-outline-danger btn-sm"><i class="fa fa-download"> Download</i></a>
                                <a href="{{route('viewTimetable',$table->id)}}" class="nav-link btn btn-outline-primary btn-sm" target=_blank ><i class="fa fa-eye"> View</i></a>
                            </span> 
                            <span class="right p-2 mx-4 text-muted">
                                {{dateFormat($table->created_at,'D jS M Y')}} <br>
                                {{$table->user->firstName}} {{$table->user->lastName}}
                            </span>
                            <br>
                            <span class="text-muted">
                                @if($table->form()->exists())
                                    {{$table->form->form_name}}

                                @else
                                    {{__('All Classes')}}
                                @endif
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
                                    </span> 
                                    <span class="right p-2 mx-4 text-muted">
                                        {{dateFormat($ttable->created_at,'D jS M Y')}} <br>
                                        {{$ttable->user->firstName}} {{$ttable->user->lastName}}
                                    </span>
                                        <br>
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
                        </span> 
                        <span class="right p-2 mx-4 text-muted">
                            {{dateFormat($table->created_at,'D jS M Y')}} <br>
                            {{$table->user->firstName}} {{$table->user->lastName}}
                        </span>
                        <br>
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