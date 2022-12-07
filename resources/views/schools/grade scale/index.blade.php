@Extends('schools.details')
@include('includes.functions')
@section('details')
    <div class="row mx-1 bg-white">
        <div class="col p-2">

        </div>
    </div>
    @foreach($school->levels as $level)
    <div class="row mx-1 bg-white mt-2">
        <div class="col p-2">
            <h4 class="border-bottom p-2">
                {{$school->school_name}} GRADING SCALES
            </h4>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Min</th>
                        <th>Max</th>
                        <th>Grade</th>
                        <th>R-Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    @endforeach
@endsection