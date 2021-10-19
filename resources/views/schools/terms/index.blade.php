@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2">
                <div class="card p-2 border-primary">
                    <div class="h4 border-bottom border-primary p-2">{{$school->school_name}} Terms
                        <span class="right">
                            <button class="btn btn-sm btn-info" onclick="ShowDiv('new-school-term')"><i class="fa fa-plus"></i> Term</button>
                        </span>
                    </div>
                    <table class="table table-sm">
                        <thead class="table-info">
                            <tr>
                                <th>Term Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Year</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($terms as $term)
                                <tr>
                                    <td>{{$term->term_name}}</td>
                                    <td>{{$term->term_start_date}}</td>
                                    <td>{{$term->term_end_date}}</td>
                                    <td>{{$term->term_year}} </td>
                                    <td>
                                        <span class="inline-block">
                                            <a href="" class="nav-link"><i class="fa fa-edit"></i></a>
                                            <a href="" class="nav-link"><i class="fa fa-trash"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4 p-2 hidden new-school-term">
                <div class="card p-2 border-primary">
                    <div class="h4 border-bottom border-primary bg-info p-2">SCHOOL TERM</div>
                    <form action="{{route('termStore')}}" id="school-term-form" method='POST'>
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="school_id" value="{{$school->id}}">
                            <label for="term_name" class="form-label">Term Name</label>
                            <input type="text" class="custom-input" name='term_name' id="term_name">
                        </div>
                        <div class="form-group">
                            <label for="term_year" class="form-label">Start Year (show transition)</label>
                            <input type="text" class="custom-input" name='term_year' id="term_year">
                        </div>
                        <div class="form-group">
                            <label for="term_start_date" class="form-label">Start Date</label>
                            <input type="date" class="custom-input" name='term_start_date' id="term_start_date">
                        </div>
                        <div class="form-group">
                            <label for="term_end_date" class="form-label">End Date</label>
                            <input type="date" class="custom-input" name='term_end_date' id="term_end_date">
                        </div>
                    </form>
                        <div class="form-group row p-2">
                            <div class="col p-2">
                                <button class="btn btn-danger btn-sm" onclick="Close('new-school-term')">Cancel</button>
                                <button class="btn btn-sm btn-primary right" type='submit' form="school-term-form">Submit</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection