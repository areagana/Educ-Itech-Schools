@Extends('layouts.users')
@section('crumbs')
    {{Breadcrumbs::render('userSubjects')}}
@endsection
@section('content')
    <div class="container">
        <div class="header p-2 h4 bg-light">Current Enrollments</div>
        @if($subjects)
            @foreach($subjects as $subject)
                <div class="p-2 border-bottom">
                    <a href="{{route('subject',$subject->id)}}" class="nav-link">
                        {{$subject->subject_name}}
                        <span class="right text-muted">
                            {{$subject->term['term_name']}}/{{$subject->term['term_year']}}
                        </span>
                    </a>
                </div>
            @endforeach
        @else
            <div class="p-2">
                <i>No current enrollments</i>
            </div>
        @endif
        <div class="header p-2 h4">Previous Enrollments</div>
        @foreach($previouses as $previous)
            <div class="p-2 border-bottom">
                <a href="{{route('subject',$previous->id)}}" class="nav-link">
                        {{$previous->subject_name}}
                    <span class="right text-muted">
                        {{$previous->term['term_name']}}/{{$previous->term['term_year']}}
                    </span>
                </a>
            </div>
        @endforeach
    </div>
@endsection