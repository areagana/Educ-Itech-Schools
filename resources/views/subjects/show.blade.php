@Extends('layouts.users')
@section('crumbs')
    {{Breadcrumbs::render('userSubjects')}}
@endsection
@section('content')
    <div class="container-fluid">
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
    </div>
@endsection