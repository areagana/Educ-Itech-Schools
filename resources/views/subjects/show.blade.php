@Extends('layouts.users')
@section('crumbs')
    {{Breadcrumbs::render('userSubjects')}}
@endsection
@section('content')
    <div class="container">
        <div class="header p-2 h4 bg-light text-primary">Current Enrollments</div>
        @if($subjects->count() > 0)
            @foreach($subjects as $subject)
                <div class="p-2 border-bottom">
                    <a href="{{route('subject',$subject->id)}}" class="nav-link">
                        {{$subject->subject_name}}
                    </a>
                </div>
            @endforeach
        @else
            <div class="p-2 h5">
                <i>You are currently not enrolled in any section</i>
            </div>
        @endif
        
    </div>
@endsection