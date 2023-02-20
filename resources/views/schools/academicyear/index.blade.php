@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row mx-2">
            <div class="col p-2">
                {{strToUpper($school->school_name)}} ACADEMIC YEARS
            </div>
            <div class="col-md-3 p-2">
                <div class="button-group">
                    <a href="{{route('add_academicyear',$school->id)}}" class="btn btn-sm btn-outline-info"><i class="fa fa-plus-circle"></i> Add</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mx-2">
            <div class="col p-2">
                <table class="table table-sm dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($academicyears as $key => $year)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$year->name}}</td>
                                <td>{{$year->start_date}}</td>
                                <td>{{$year->end_date}}</td>
                                <td class='inline-block'>
                                    <a href="{{route('edit_academicyear',$year->id)}}" class="nav-link"><i class="fa fa-edit"></i></a>
                                    <a href="" class="nav-link"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection