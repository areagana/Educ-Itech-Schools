@Extends('schools.details')
@include('includes.functions')
@section('details')
    <div class="row p-2">
        <div class="col p-2">
            <h3 class='header'>{{$exam->exam_name}} GRADESHEET
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
            <div class="p-2 gradesheet bg-white border border-primary" id='gradesheet'>
                @if(isset($students) && $students->count() > 0)
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class='text-center' colspan='{{ 5 + $level->subjects()->count()}}'>{{$school->school_name}} {{$form->form_name}} {{($stream) ? $stream->name: ''}}  ({{$exam->exam_name}}) GRADESHEET</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>NAME</th>
                            <th>STREAM</th>
                            @foreach($level->subjects as $subject)
                                <th>{{$subject->short_name}}</th>
                            @endforeach
                            <th>AGG</th>
                            <th>DIV</th>
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
                                    <td>{{gradeMark($mark)}}</td>
                                @endforeach
                                <td>{{array_sum($total_marks)}}</td>
                                <td>{{average($total_marks)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>  
                @endif 
            </div>
        </div>
    </div>
@endsection