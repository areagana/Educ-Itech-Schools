@Extends('schools.details')
@include('includes.functions')
@section('details')
    <div class="row mx-1 bg-white">
        <div class="col p-2">
            <h2 class='p-2 border-bottom'>{{$school->school_name}} GRADING SCALES
                <span class="right">
                    <a href='#' data-toggle='modal' data-target='#new_grade_scale' class="btn btn-flat btn-sm btn-success"><i class="fa fa-plus-circle"></i> Add Scale</a>
                </span>
            </h2>
        </div>
    </div>
    @foreach($school->levels as $level)
    <div class="row mx-1 bg-white mt-2 border border-primary">
        <div class="col p-2">
            <h4 class="border-bottom p-2">
                {{$school->school_name}} GRADING SCALE ({{$level->name}})
            </h4>
            <table class="table table-sm data-table">
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
                    @foreach($school->gradings as $scale)
                        <tr>
                            <td>{{$scale->min_value}}</td>
                            <td>{{$scale->max_value}}</td>
                            <td>{{$scale->grade_value}}</td>
                            <td>{{$scale->grade}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach

    <!-- modal -->
    <div class="modal fade" id="new_grade_scale" tabindex="-1" data-backdrop='static' role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">{{$school->school_name}} new Grading Scale</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('storeGrade',$school->id)}}" method='POST' id='save_scale_form'>
                        @csrf
                        <div class="form-row">
                            <div class="col p-2">
                                <select name="level_id" id="" class="form-control" required>
                                    <option value="">Select Level</option>
                                    @foreach($school->levels as $level)
                                        <option value="{{$level->id}}">{{$level->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <h6 class="p-2 border-bottom">ORDINARY</h6>
                        <div class="form-row">
                            <div class="col p-2 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Min</span>
                                </div>
                                <input type="text"  name='min_value' class="form-control">
                            </div>
                            <div class="col p-2 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Max</span>
                                </div>
                                <input type="text"  name='max_value' class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col p-2 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Value</span>
                                </div>
                                <input type="text"  name='grade_value' class="form-control">
                            </div>
                            <div class="col p-2 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Grade</span>
                                </div>
                                <input type="text"  name='grade' class="form-control">
                            </div>
                        </div>

                        <h6 class="p-2 border-bottom">ADVANCED SCALE</h6>

                        <div class="form-row">
                            <div class="col p-2 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Papers</span>
                                </div>
                                <input type="text"  name='gradable' class="form-control">
                            </div>
                            <div class="col p-2 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">At least</span>
                                </div>
                                <input type="text"  name='min_gradable' class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col p-2 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Lowest gd</span>
                                </div>
                                <input type="text"  name='lowest_value' class="form-control">
                            </div>
                            <div class="col p-2 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Highest gd</span>
                                </div>
                                <input type="text"  name='highest_value' class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col p-2 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">AVG</span>
                                </div>
                                <input type="text"  name='average' class="form-control">
                            </div>
                            <div class="col p-2 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">AWARD</span>
                                </div>
                                <input type="text"  name='award' class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" form='save_scale_form'>Save Scale</button>
                </div>
            </div>
        </div>
    </div>
@endsection