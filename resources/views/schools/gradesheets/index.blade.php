@Extends('schools.details')
@section('details')
    <div class="row mx-2 justify-content-center">
        <div class="col-md-6 col-md-offset-2 align-center p-2 ">
            <div class="card w-auto">
                <div class="card-header strong">
                    {{$school->school_name}} GRADESHEET GENERATION
                </div>
                <div class="card-body">
                    <form action="{{route('gradeSheetView')}}" method='POST' id='marksheet-form'>
                        @CSRF
                        <div class="form-row">
                            <div class="col p-2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">SELECT TERM</span>
                                    </div>
                                    <select name="term_id" id="" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach($school->terms as $term)
                                            <option value="{{$term->id}}">
                                                {{$term->term_name}}
                                                <span class="right">{{$term->term_year}}</span>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col p-2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">SELECT EXAM</span>
                                    </div>
                                    <select name="exam_id" id="" class="form-control" required>
                                        <option value="">Select exam</option>
                                        @foreach($term->exams as $exam)
                                            <option value="{{$exam->id}}">{{$exam->exam_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col p-2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">SELECT CLASS</span>
                                    </div>
                                    <select name="form_id" id="" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach($school->forms as $form)
                                            <option value="{{$form->id}}">{{$form->form_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col p-2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">SELECT STREAM</span>
                                    </div>
                                    <select name="stream_id" id="" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($school->streams as $stream)
                                            <option value="{{$stream->id}}">{{$stream->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-flat right" form='marksheet-form'>Load Marksheet</button>
                </div>
            </div>
            
        </div>
    </div>
@endsection