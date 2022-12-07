@Extends('layouts.app')
@section('crumbs')

@endsection
@section('content')
<div class="container-fluid p-2">
    <div class="row mx-2">    
        @foreach($schools as $school)
            <div class="col p-2 bg-white m-2">
                <h4 class="p-2 border-bottom">{{$school->school_name}}</h4>
                <div class="p-2">
                    Students: {{$school->students()->count()}} 
                </div>
                <div class="p-2">
                    Users: {{$school->users()->count()}}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection