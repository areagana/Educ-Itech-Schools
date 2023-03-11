@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2">
                <div class="card p-2 border-primary">
                    <div class="h4 border-bottom border-primary p-2">{{$school->school_name}} - Terms
                        @if(!$term)
                            @if(Auth::user()->isAbleTo('term-create'))
                                <span class="right">
                                    <button class="btn btn-sm btn-info" onclick="ShowDiv('new-school-term')"><i class="fa fa-plus"></i> Term</button>
                                </span>
                            @endif
                        @endif
                    </div>
                    <table class="table table-sm dataTable">
                        <thead class="table-info">
                            <tr>
                                <th>Term Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Ac_Year</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schoolterms as $current)
                                <tr>
                                    <td>{{$current->term_name}}</td>
                                    <td>{{$current->term_start_date}}</td>
                                    <td>{{$current->term_end_date}}</td>
                                    <td>{{($current->academicyear) ? $current->academicyear->name : ""}} </td>
                                    <td>
                                        @if($current->term_end_date >= date('Y-m-d'))
                                            <span class="text-success">{{__('Active')}}</span>
                                        @else
                                            <span class="text-danger">{{__('Ended')}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="inline-block">
                                            @if(Auth::user()->isAbleTo('term-update') && isset($current->academicyear) && $current->academicyear->end_date >= date('Y-m-d') )
                                                <a href="#edit-term{{$current->id}}" class="nav-link" data-toggle='modal'><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(Auth::user()->isAbleTo('term-delete') && $current->exams()->count() ==0 )
                                                <a href="#" class="nav-link" onclick="xdialog.confirm('Confirm to delete this term?',function(){deleteItem({{$current->id}},'/term/delete')})"><i class="fa fa-trash"></i></a>
                                            @endif
                                            </span>
                                        
                                        <div class="modal fade" id="edit-term{{$current->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">{{$current->term_name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="p-2">
                                                            <form action="{{route('termUpdate')}}" id="edit-term-form{{$current->id}}" method='POST'>
                                                                @csrf
                                                                <div class="form-group">
                                                                    <input type="hidden" name="school_id" value="{{$school->id}}">
                                                                    <input type="hidden" name="term_id" value="{{$current->id}}">
                                                                    <input type="hidden" class="custom-input" name='academicyear_id' value="{{($acyear) ? $acyear->id : ''}}">
                                                                    <label for="term_name" class="form-label">Term Name</label>
                                                                    <input type="text" class="custom-input" name='term_name' id="term_name" value='{{$current->term_name}}'>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="term_year" class="form-label">Start Year (show transition)</label>
                                                                    <input type="text" class="custom-input" name='term_year' id="term_year" value='{{$current->term_year}}'>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="term_start_date" class="form-label">Start Date</label>
                                                                    <input type="date" class="custom-input" name='term_start_date' id="term_start_date" value='{{$current->term_start_date}}'>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="term_end_date" class="form-label">End Date</label>
                                                                    <input type="date" class="custom-input" name='term_end_date' id="term_end_date" value='{{$current->term_end_date}}'>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                        <button  class="btn btn-primary btn-sm" type='submit' form="edit-term-form{{$current->id}}">Update Term Data</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                            <input type="hidden" class="custom-input" name='academicyear_id' value="{{($acyear) ? $acyear->id : ''}}">
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