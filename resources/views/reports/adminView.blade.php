@Extends('layouts.schoolHome')
@section('crumbs')

@endsection
@section('schoolContent')
    <div class="row mx-1 border-bottom">
        <div class="col p-2">
            <h3 class="p-2">GENERATE ACADEMIC REPORTS</h3>
        </div>
    </div>
    <div class="row mx-1">
        <div class="col p-2">
            <form action="{{route('pdfreport')}}" method='post' target=_blank>
                @csrf
                <div class="form-row">
                    <div class="col p-2">
                        <label for="">Level</label>
                        <select name="" id="" class='form-control'>
                            <option value="">Select</option>
                            @foreach($school->levels as $level)
                                <option value="{{$level->id}}">{{$level->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col p-2">
                        <label for="">Class</label>
                        <select name="form_id" id="form_id" class="form-control">
                            <option value="">Select</option>
                            @foreach($school->forms as $form)
                                <option value="{{$form->id}}">{{$form->form_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col p-2">
                        <label for="">Stream</label>
                        <select name="stream_id" id="stream_id" class="form-control">
                            <option value="">Select</option>
                            @foreach($school->streams as $stream)
                                <option value="{{$stream->id}}">{{$stream->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col p-2">
                        <input type="checkbox" name="enable_topics" id="enable_topics" zoom='2' value='1' class="form-check-input">
                        <label for="enable_topics">Include Topics</label>
                    </div>
                    <div class="col p-2">
                        <label for="">Number</label>
                        <input type="text" class="form-control" id="number_topics">
                    </div>
                    <div class="col p-2">
                        <label for="">Term</label>
                        <select name="" id="term_topics" class="form-control">
                            <option value="">Select</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col p-2">
                        <label for="">Exams to Consider (Number)</label>
                        <input type="number" name='exam_number' min='1' max='{{$term->exams()->count()}}' class="form-control">
                    </div>
                    <div class="col p-2">
                        <label for="">Exams</label>
                        <select name="exam_id" id="exams_select" class="form-control">
                            <option value="">Select</option>
                            @foreach($term->exams as $exam)
                                <option value="{{$exam->id}}">{{$exam->exam_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="p-2 border-bottom bg-white">
                    Promote students?
                </div>
                <div class="form-row mx-2">
                    <div class="col p-2">
                        <div class="p-2">
                            <input type="radio" name="promote" id="promote_yes" value='1' class="form-check-input">
                            <label for="promote_yes">Yes</label>
                        </div>
                    </div>
                    <div class="col p-2">
                        <div class="p-2">
                            <input type="radio" name="promote" id="promote_no" value='0' class="form-check-input">
                            <label for="promote_no">No</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col p-2">
                        <button type="submit" class='btn btn-flat btn-primary right'>Generate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection