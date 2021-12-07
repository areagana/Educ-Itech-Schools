@Extends('layouts.schoolHome')
@section('crumbs')

@endsection
@include('includes.functions')
@section('schoolContent')
    <div class="row p-2">
        <div class="col">
            <div class="header h3">Assessments</div>
            <div class="row p-2">
                <div class="col p-2 bg-white m-2">
                    <div class="p-2 h5">Exams </div>
                    <div class="p-2 row">
                        <div class="col p-2">
                            <img src="{{asset('exams-icon.png')}}" width="50px" height="40px" class="rounded-circle">
                        </div>
                        <div class="col p-2 border-left justify-content-center">
                            <span class="h3">{{$school->exams->count()}}</span>
                        </div>
                        <div class="col p-2 border-left">
                            <span class="h6">
                                <a href="#" class="nav-link" onclick="ShowDiv('new-exam')"><i class="fa fa-plus-circle"></i></a>
                                <a href="" class="nav-link"><i class="fa fa-eye"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            <!--new-exam model-->
            @if($term)
                <div class="shadow bg-white floating-div new-exam border border-primary position-absolute hidden">
                    <div class="border-bottom h4 p-2"> NEW SCHOOL EXAM
                        <span class="right btn  btn-sm btn-outline-danger" onclick="Close('new-exam')">&times;</span>
                    </div>
                    <div class="p-2">
                        <form action="{{route('examStore')}}" method ='POST' id="new-exam-form">
                            @csrf
                            <div class="row p-1">
                                <div class="col p-2">
                                    <div class="form-group">
                                        <input type="hidden" name="school_id" value="{{$school->id}}">
                                        <input type="hidden" name="term_id" value="{{$term->id}}">
                                        <label for="exam_name" class="form-label">Exam Name</label>
                                        <input type="text" class="custom-input" name ='exam_name' id="exam_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exam_classes" class="form-label">Class</label>
                                        <select name="exam_class" id="exam_classes" class="custom-select" required>
                                            <option value="All classes">All Classes</option>
                                            @foreach($school->forms as $form)
                                                <option value="{{$form->id}}">{{$form->form_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class='custom-input' required>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" name="end_date" id="end_date" class='custom-input' required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lock_date" class="form-label">Lock Date (Optional) (<i class='text-danger'>Locks Mark entry</i>)</label>
                                        <input type="date" name="lock_date" id="lock_date" class='custom-input'>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2 border-left">
                                    <div class="form-group">
                                        <label for="total_points" class="form-label">Total Points</label>
                                        <input type="number" name="total_points" id="total_points" class="form-control" required>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="add_to_reports" id="add_to_reports" value='1' class="form-check-input" zoom="2%">
                                        <label for="add_to_reports" class="form-check-label">Include on final report</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2">
                                <div class="col p-2">
                                    <button type="submit" class="btn btn-outline-primary right">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @else
                <div class="success-alert-message bg-white shadow border border-success row p-2 position-absolute m-4 hidden">
                    <div class="col-md-1">
                    <img src="{{asset('notice-icon.jpg')}}" width='40px' height='40px' class='rounded-circle'>
                    </div>
                    <div class="col-md-9 p-2 bg-white message-display">
                        No term has been set yet.
                    </div>
                    <div class="col-md-1 p-2">
                    <button class="close" data-dismiss='alert' onclick="Close('success-alert-message')">&times;</button>
                    </div>
              </div>
                @endif
                <div class="col p-2 bg-white m-2">
                    <div class="p-2 h5">Course Works
                    </div>
                    <div class="p-2">
                        <div class="p-2 row">
                            <div class="col p-2">
                                <img src="{{asset('exams-icon.png')}}" width="50px" height="40px" class="rounded-circle">
                            </div>
                            <div class="col p-2 border-left justify-content-center">
                                <span class="h3">{{$school->exams->count()}}</span>
                            </div>
                            <div class="col p-2 border-left">
                                <span class="h6">
                                    <a href="" class="nav-link"><i class="fa fa-plus-circle"></i></a>
                                    <a href="" class="nav-link"><i class="fa fa-eye"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col p-2 bg-white m-2">
                    <div class="p-2 h5">Results</div>
                    <div class="p-2">
                        <div class="p-2 row">
                            <div class="col p-2">
                                <img src="{{asset('exams-icon.png')}}" width="50px" height="40px" class="rounded-circle">
                            </div>
                            <div class="col p-2 border-left">
                                <span class="h3">{{$school->exams->count()}}</span>
                            </div>
                            <div class="col p-2 border-left">
                                <span class="h6">
                                    <a href="" class="nav-link"><i class="fa fa-plus-circle"></i></a>
                                    <a href="" class="nav-link"><i class="fa fa-eye"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-2">
                <div class="col p-2 bg-white m-2">
                    <div class="p-2 h5">Marksheets</div>
                    <div class="p-2">

                    </div>
                </div>
                <div class="col p-2 bg-white m-2">
                    <div class="p-2 h5">Grade sheets</div>
                    <div class="p-2">

                    </div>
                </div>
                <div class="col p-2 bg-white m-2">
                    <div class="p-2 h5">Analysis</div>
                    <div class="p-2">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <h3 class="header bg-white">Exams</h3>
            @foreach($school->exams as $exam)
                <div class="p-2 shadow-sm school-exam bg-white mt-1">
                    {{$exam->exam_name}} <br>
                    <span class="text-muted">{{$exam->term->term_name}}</span> <br>
                    <span class=" text-muted">
                        @if(date($exam->end_date) >= date('Y-m-d'))
                            <i class="text-success right">Runnning..</i> <br>
                            <i>Ends on: <u>{{dateFormat($exam->end_date,'D jS M y')}}</u>
                        
                            <span class="right" onclick="xdialog.confirm('Delete this Exam?',function(){deleteItem({{$exam->id}},'/exam/delete')})">&times;</span></i>

                        @else
                            <i class="text-danger">Closed</i>
                        @endif
                    </span>
                </div>
            @endforeach
        </div>
    </div>
@endsection