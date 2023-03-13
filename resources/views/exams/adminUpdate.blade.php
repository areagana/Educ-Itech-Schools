@Extends('layouts.schoolHome')
@include('includes.functions')
@section('crumbs')
    {{Breadcrumbs::render('Results',$exam,$school,$form,$subject)}}
@endsection
@section('schoolContent')
    <div class="row mx-1">
        <div class="col p-2 border-bottom">
            <div class="h3">{{$form->form_name}} {{$subject->subject_name}} ({{$exam->exam_name}}) Results</div>
        </div>
    </div>
    <div class="row mx-1">
        <div class="col p-2">
            <form action="{{route('markUpdateAdmin')}}" id='admin_update_form' method='POST'>
                @csrf
                    <input type="hidden" name="subject_id" value="{{$subject->id}}">
                    <input type="hidden" name="school_id" value="{{$school->id}}">
                    <input type="hidden" name="exam_id" value="{{$exam->id}}">
                    <input type="hidden" name="form_id" value="{{$form->id}}">
                    <input type="hidden" name="term_id" value="{{$term->id}}">
                    <input type="hidden" name="paper_id" value="{{($subject->paper) ? $subject->paper->id : ''}}">
                    <div class="col">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($form->students as $key=> $student)
                            @php
                                $mark = userExamMarks($student,$exam,$subject,isset($paper) ? $paper : '');
                            @endphp
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$student->firstname}} {{$student->lastname}}</td>
                                <td>
                                    <input type="hidden" name="student_id[]" value="{{$student->id}}">
                                    <input type="number" name="marks[]" id="marks{{++$key}}" value="{{$mark}}" class="form-control" width="40px" max='{{$exam->total_points}}' min='0'>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <div class="row p-2">
        <div class="col p-2">
            <button class="btn btn-primary right" type='submit' form='admin_update_form' >Submit Marks</button>
            <!-- onclick="xdialog.startSpin()" -->
        </div>
    </div>
@endsection