@Extends('schools.details')
@include('includes.functions')
@section('details')
    <div class="row p-2">
        <div class="col p-2">
            <h3 class='header'>{{$exam->exam_name}} MARKSHEET
                <form action="{{route('marksheetView')}}" method='POST'>
                    @csrf
                    <div class="input-group">
                        <input type="hidden" name="exam_id" value="{{$exam->id}}">
                        <select name="form_id" id="form_id" class="custom-select custom-select-sm">
                            <option value="">Select Class</option>
                            @foreach($school->forms as $form)
                                <option value="{{$form->id}}">{{$form->form_name}}</option>                            
                            @endforeach
                        </select>
                        <select name="stream_id" id="stream_id" class="custom-select custom-select-sm">
                            <option value="">Select Class</option>
                            @foreach($school->streams as $stream)
                                <option value="{{$stream->id}}">{{$stream->name}}</option>                            
                            @endforeach
                        </select>
                        <button type='submit' class="btn btn-sm btn-primary">Generate</button>
                        <button type='button' class="btn btn-sm btn-danger" onclick="printPage('gradesheet')"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
                
            </h3>
            <!-- generate marksheet here -->
            <div class="p-2 gradesheet bg-white" id='gradesheet'>
                @if(isset($students) && $students->count() > 0)
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th></th>
                            @foreach($level->subjects as $subject)
                                <th colspan="{{$subject->papers + 1}}">{{$subject->short_name}}</th>
                            @endforeach
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>NAME</th>
                            <th>STREAM</th>
                            @foreach($level->subjects as $subject)
                                @for($i=1;$i<=$subject->papers;$i++)
                                    <th>P{{$i}}</th>
                                @endfor
                                <th>GD</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $key=> $student)
                            @php
                                $total_marks =[];
                            @endphp
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$student->firstname}} {{$student->middlename}} {{$student->lastname}}</td>
                                <td>{{($student->stream) ? $student->stream->name : ''}}</td>
                                @foreach($level->subjects as $subject)
                                    @php
                                        $mark = userExamMarks($student,$exam,$subject);
                                        $total_marks[] = $mark;
                                    @endphp
                                    @for($i=1;$i<=$subject->papers;$i++)
                                        <td>{{$mark}}</td>
                                    @endfor
                                        <td>gd</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>  
                @elseif($students->count() <= 0)
                    <div class="p-2 h4 m-2">
                        <i>No students registered for {{$form->form_name}}</i>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection