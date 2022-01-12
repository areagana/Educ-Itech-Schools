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
                        <div class="col-md-2 p-2 border-left justify-content-center">
                            <span class="h3">{{$school->exams->count()}}</span>
                        </div>
                        <div class="col p-2 border-left">
                            <span class="h6">
                                <a href="#" class="nav-link" onclick="ShowDiv('new-exam')"><i class="fa fa-plus-circle"></i> Add</a>
                                <a href="" class="nav-link"><i class="fa fa-eye"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            <!--new-exam model-->

                <div class="shadow bg-white floating-div new-exam border border-primary position-absolute hidden">
                    <div class="border-bottom h4 p-2"> NEW SCHOOL EXAM
                        <span class="right btn  btn-sm btn-outline-danger" onclick="Close('new-exam')">&times;</span>
                    </div>
                    <div class="p-2">
                        @if($term)
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
                        @else
                        <div class="aler alert-info p-2">
                            No term has started yet and thus no exam can be set.
                        </div>
                        <div class="success-alert-message bg-white shadow border border-success row p-2 position-absolute m-4">
                            <div class="col-md-1">
                                <img src="{{asset('notice-icon.jpg')}}" width='40px' height='40px' class='rounded-circle'>
                            </div>
                            <div class="col-md-9 p-2 bg-white message-display">
                                No exam can be set before the term starts.
                            </div>
                            <div class="col-md-1 p-2">
                                <button class="close" data-dismiss='alert' onclick="Close('success-alert-message')">&times;</button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>


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
                    <div class="p-2 h5">Reports</div>
                    <div class="p-2">
                        <div class="p-2 row">
                            <div class="col p-2">
                                <a href="#" class="nav-link border-bottom p-2" onclick="ShowDiv('report-conditions')">Conditions</a>
                                <a href="#" class="nav-link border-bottom p-2" onclick="ShowDiv('report-forms')">Generate</a>
                                <div class="p-2 absolute shadow more report-forms">
                                    @foreach($school->forms as $form)
                                        <a href="{{route('examReport',$form->id)}}" class="nav-link">{{$form->form_name}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--setting reports conditions for generation-->
                <div class="shadow bg-white floating-div new-exam report-conditions border border-primary position-absolute hidden p-0">
                    <div class="border-bottom h4 p-2 bg-info"> Set Report Conditions
                        <span class="right btn  btn-sm btn-outline-danger" onclick="Close('report-conditions')">&times;</span>
                    </div>
                    <div class="row p-2">
                        <div class="col p-2">
                            <h5 class="header">Major points to consider</h5>
                            <div class="p-2">
                                <div class="p-2 form-check ml-3">
                                    <input type="checkbox" name="exams" id="exams-contribution" class="form-check-input" onclick="displayChecked('exam-contribution')">
                                    <label for="exams-contribution" class="form-check-label">Exams and Contributions</label>
                                </div>
                                <div class="p-2 form-check ml-3">
                                    <input type="checkbox" name="subjects" id="subjects-done" class="form-check-input" onclick="displayChecked('subjects-done')">
                                    <label for="subjects-done" class="form-check-label">Subjects Done</label>
                                </div>
                                <div class="p-2 form-check ml-3">
                                    <input type="checkbox" name="fees" id="fees" class="form-check-input">
                                    <label for="fees" class="form-check-label">School fees</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 row">
                        <div class="col p-2 exam-contribution">
                            <h5 class="header">Exam Contribution</h5>
                            @if($term)
                                @if($term->exams->count() > 0)
                                    @foreach($term->exams as $exam)
                                        @if($exam->add_to_reports == true)
                                            <div class="p-2 form-check form-group ml-3">
                                                <input type="checkbox" name="exam_id[]" class='form-check-input' id="exam_id{{$exam->id}}" value="{{$exam->id}}">
                                                <label for="exam_id{{$exam->id}}" class='form-check-label'>
                                                    {{$exam->exam_name}}
                                                </label>
                                                <span class="right">
                                                    <input type="text" name="exam_contribution[]" class="form-control form-control-sm">
                                                </span>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        </div>
                        <div class="col-md-3 p-2 subjects-done hidden">
                            <h5 class="header">Subjects</h5>
                            <div class="p-2">

                            </div>
                        </div>
                    </div>
                </div>
            <!--end report conditions generation-->
            </div>
            <div class="row p-2">
                <div class="col p-2 bg-white m-2">
                    <div class="p-2 h5 header">Marksheets</div>
                    <div class="p-2">
                        @foreach($school->exams as $exam)
                        <a href="{{route('marksheet',$exam->id)}}" class="nav-link text-dark">
                            <div class="p-2 border-bottom">
                                {{$exam->exam_name}}
                                @if($exam->examresults->count() > 0)
                                    <span class="right">
                                        <img src="{{asset('Ticked Circle.jpg')}}" alt="" width="25px" height="25px">
                                    </span>
                                @endif
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="col p-2 bg-white m-2">
                    <div class="p-2 h5">Grade sheets</div>
                    <div class="p-2">
                        @foreach($school->exams as $exam)
                        <a href="{{route('gradesheetView',$exam->id)}}" class="nav-link text-dark">
                            <div class="p-2 border-bottom">
                                {{$exam->exam_name}}
                                @if($exam->examresults->count() > 0)
                                <span class="right">
                                    <img src="{{asset('Ticked Circle.jpg')}}" alt="" width="25px" height="25px">
                                </span>
                                @endif
                            </div>
                        </a>    
                        @endforeach
                    </div>
                </div>
                <div class="col p-2 bg-white m-2">
                    <div class="p-2 h5">Analysis</div>
                    <div class="p-2">
                        @foreach($school->exams as $exam)
                            <div class="p-2 border-bottom">
                                {{$exam->exam_name}}
                                @if($exam->examresults->count() > 0)
                                <span class="right">
                                    <img src="{{asset('Ticked Circle.jpg')}}" alt="" width="25px" height="25px">
                                </span>
                                @endif
                            </div>
                        @endforeach
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