@Extends('layouts.schoolHome')
@section('crumbs')
    {{Breadcrumbs::render('schoolView',$school,$school->id)}}
@endsection
@section('schoolContent')
<!-- school term name-->
@if(!$term)
<!-- term notification-->
<div class="term-notice shadow bg-white p-2 justify-content-center row absolute">
    <div class="col p-2 notice-info">
        <h4 class="header"><i><b>Notice</b></i></h4>
        @if(!$term)
            <span>
                No term has been set for your school. Please contact the school administrator to have a school term setup. <br>
                Thank You. <br>
            </span>
        @endif
    </div>
    <div class="col-md-2 p-2 border-left">
        <button class="btn btn-light btn-sm right" onclick="Close('term-notice')" @popper(Close)>&times;</button>
    </div>
</div>
@endif
<!--end term notification-->
<div class="container-fluid">
    @yield('details')
</div>
@endsection