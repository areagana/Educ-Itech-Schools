@Extends('layouts.subjectView')
@section('crumbs')
    {{Breadcrumbs::render('assignment.show',$subject,$assignment,$subject->id,$assignment->id)}}
@endsection
@section('subjectContent')
    <div class="container-fluid">
        <h2>
            Waaoooohhh!! <br>
            You have successfully submitted your assignment
        </h2>

        <div class="p-2">
            <h4 class="header">Details</h4>
            Attachments: {{count($files)}}
            Assignment Names:{{dd($files)}}
        </div>
    </div>
@endsection