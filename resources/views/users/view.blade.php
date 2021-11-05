@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2 bg-white">
            <div class="col-md-4 p-2">
                <b>User_id:</b> {{$user->id}}
                @if($user->barcode)
                    {!! DNS1D::getBarcodeHTML($user->barcode, 'UPCA') !!}
                    {{$user->barcode}}
                @else
                    {!! DNS1D::getBarcodeHTML('100', 'UPCA') !!}
                    {{__(100)}}
                @endif
            </div>
            <div class="col-md-6 p-2">
                <b>First Name:</b> {{$user->firstName}} <br>
                <b>Last Name:</b> {{$user->lastName}} <br>
                <b>Class:</b> {{$user->forms()->latest()->first()->form_name}} 
            </div>
            <div class="col-md-2 p-2">
                <img src="" alt="" width='80px' height='90px'>
            </div>
        </div>
        <div class="row p-2 bg-white">

        </div>
    </div>
@endsection