@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row mx-2">
            <div class="col p-2">
                {{strToUpper($school->school_name)}} ACADEMIC YEARS
            </div>
            <div class="col-md-3 p-2">
                <div class="button-group">
                    <a href="{{route('add_academicyear',$school->id)}}" class="nav-link"></a>
                    <button class="btn btn-sm btn-outline-info"><i class="fa fa-plus-circle"></i> Add</button>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mx-1">
            <div class="col p-2">
                <form action="{{route('save_acyear')}}" method='POST'>
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name='name' class="form-control" required>
                        <input type="hidden" name="school_id" value="{{($school->id) ? $school->id : ''}}">
                    </div>
                    <div class="form-group">
                        <label for="">Start Date</label>
                        <input type="date" name='start_date' class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">End date</label>
                        <input type="date" name='end_date' class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type='submit' class="btn btn-primary right">Save</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 p-2">
                @foreach($academicyears as $year)
                    <div class="p-2">
                        {{$year->name}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection