
@Extends('layouts.subjectView')
@section('crumbs')
    {{Breadcrumbs::render('assignment.show',$subject,$assignment,$subject->id,$assignment->id)}}
@endsection
@section('subjectContent')
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-md-9 p-2 bg-white">
                <h3 class='header'>{{$assignment->assignment_name}}</h3>
                <div class="p-2">
                    {!!$assignment->assignment_content!!}
                </div>
                <div class="row p-2">
                    <div class="col p-1">
        <!-- enable this for students-->
                   
                        <a href="{{route('assignment.attempt',[$subject->id,$assignment->id])}}" class="nav-link">
                            <button class="btn btn-primary btn-sm right">Attempt Assignment</button>
                        </a>
                    
                    </div>
                </div>
            </div>
            <div class="col p-2 mx-1 bg-white">
                <h4 class="border-bottom p-2">To Do</h4>
            </div>
        </div>
        <div class="row p-1">
            <div class="col p-2">
                

            </div>
        </div>
    </div>
@endsection