@Extends('layouts.schoolHome')
@section('crumbs')

@endsection
@section('schoolContent')
    <div class="row mx-1 border-bottom">
        <div class="col p-2">
            <h3 class="p-2">GENERATE ACADEMIC REPORTS</h3>
        </div>
    </div>
    <div class="row mx-2">
        <div class="col-md-6 p-2">
            <form action="{{route('pdfreport')}}" method='post' target=_blank>
                @csrf
                <div class="row mx-1 mt-1">
                    <div class="col-md-4 p-0">
                        <label for="">Academic Year</label>
                    </div>
                    <div class="col p-0">
                        <select name="academic_year" id="academic_year" class="form-control">
                            <option value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                            @foreach($school->academicyears as $year)
                                <option value="{{$year->id}}">{{$year->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mx-1 mt-1">
                    <div class="col-md-4 p-0">
                        <label for="">Level</label>
                    </div>
                    <div class="col p-0">
                        <select name="Level_id" id="level_id" class='form-control' onchange="loadLevelData($(this).val())">
                            <option value="">Select</option>
                            @foreach($school->levels as $level)
                                <option value="{{$level->id}}">{{$level->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mx-1 mt-1">
                    <div class="col-md-4 p-0">
                        <label for="class_id">Class</label>
                    </div>
                    <div class="col p-0">
                        <select name="form_id" id="class_id" class="form-control">
                            <option value="">Select</option>
                            @foreach($school->forms as $form)
                                <option value="{{$form->id}}">{{$form->form_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mx-1 mt-1">
                    <div class="col-md-4 p-0">
                        <label for="">Stream</label>
                    </div>
                    <div class="col p-0">
                        <select name="stream_id" id="stream_id" class="form-control">
                            <option value="">Select</option>
                            @foreach($school->streams as $stream)
                                <option value="{{$stream->id}}">{{$stream->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mx-1 mt-1">
                    <div class="col-md-4 p-0">
                        <label for="">Term</label>
                    </div>
                    <div class="col p-0">
                        <select name="" id="term_topics" class="form-control">
                            <option value="{{$term->id}}">{{$term->term_name}}</option>
                        </select>
                    </div>
                </div>
                <div class="row mx-1 mt-1">
                    <div class="col-md-4 p-0">
                        <label for="">Topics</label>
                    </div>
                    <div class="col p-0">
                        <input type="text" class="form-control" id="number_topics">
                    </div>
                </div>
                <div class="row mx-1 mt-1">
                    <div class="col-md-4 p-0">
                        <label for="">Exams</label>
                    </div>
                    <div class="col p-0">
                        <input type="number" class="form-control" id="exam_number" min='1' max='10'>
                    </div>
                </div>
                <div class="row mx-1 mt-1">
                    <div class="col-md-4 p-0">
                        <label for="">Exam Select</label>
                    </div>
                    <div class="col p-0">
                        <select name="exam_id" id="exams_select" class="form-control">
                            <option value="">Select</option>
                            @foreach($exams as $exam)
                                <option value="{{$exam->id}}">{{$exam->exam_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mx-1">
                    <div class="col p-2">
                        <button type="submit" class='btn btn-flat btn-primary right'>Generate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection