@Extends('layouts.subjectView')
@section('crumbs')

@endsection
@section('subjectContent')
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col p-2 bg-white shadow-sm border-bottom">
                <div class='header p-3 h5'>{{$note->note_title}}
                    <span class="right bg-danger h6 ">
                        <a href="{{route('CreatePDF',$note->id)}}" class="nav-link text-white" @popper(Convert to PDF)><i class="fa fa-share"></i> PDF</a>
                    </span>
                </div>
                <div class="p-2">
                    {!!$note->note_content!!}
                </div>
            </div>
            <div class="col-md-2 p-2 bg-white ml-1 shadow-sm">

            </div>
        </div>
    </div>
@endsection