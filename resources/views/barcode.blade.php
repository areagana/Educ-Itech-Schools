@Extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row p-2">
            <div class="col p-2">
                <div class="header">Bar Code</div>
                <div class="barcodeCode">
                    <div>{!! DNS1D::getBarcodeHTML('44456', 'UPCA') !!}</div>

                    <!-- add a datatable here-->


                </div>
            </div>
        </div>
    </div>
    <script>
        
    </script>
@endsection