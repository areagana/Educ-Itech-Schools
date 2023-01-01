@Extends('layouts.subjectView')
@include('includes.functions')
@section('crumbs')
    {{Breadcrumbs::render('subject',$subject,Auth::user()->school,Auth::user()->school->id)}}
@endsection
@section('subjectContent')
<div class="row mx-1">
    <div class="col p-2">
        <div class="row  border-bottom bg-white">
            <div class="col p-2">
                {{$form->form_name}} {{$subject->subject_name}} - Mark Update
            </div>
        </div>
        <div class="p-1 border-bottom row">
            <div class="col p-2">
                <h3 class="p-2"><b>EXAM :</b> {{$exam->exam_name}}</h3>
            </div>
            <div class="col p-2">
                <input type="text" name="searchName" id="searchName" onkeyup='searchStudent()' class="form-control" placeholder='Search...'>
                <input type="hidden" name="card_id" value='{{$card->id}}' id='card_id'>
                <input type="hidden" name="form" value='{{$form->id}}' id='form'>
                <input type="hidden" name="card_id" value='{{$subject->id}}' id='subject_id'>
            </div>
        </div>
        <div class="row mx-0">
            <div class="p-2 bg-white" id='update_marks_list'>
                <form action="{{route('markUpdate')}}" id="mark-input-form" method='POST'>
                    @csrf
                    <input type="hidden" name="subject_id" value="{{$subject->id}}">
                    <input type="hidden" name="school_id" value="{{$school->id}}">
                    <input type="hidden" name="exam_id" value="{{$exam->id}}">
                    <input type="hidden" name="form_id" value="{{$form->id}}">
                    <input type="hidden" name="card_id" value="{{$card->id}}">
                    <input type="hidden" name="paper_id" value="{{($card->paper) ? $card->paper->id : ''}}">
                    <div class="col">
                        <table class="table table-sm">
                            <thead class="table-info">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mark( /{{$exam->total_points}})</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody id='subject-people-results{{$exam->id}}'>
                                @foreach($students as $key=> $member)
                                            @php
                                                $mark = userExamMarks($member,$exam,$subject,$paper);
                                            @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$member->firstname}} {{$member->middlename}} {{$member->lastname}}</td>
                                        <input type="hidden" name="student_id[]" value="{{$member->id}}">
                                        <td><input type="number" name="marks[]" value="{{$mark}}" class="form-control form-control-sm mark-input" width="40px" max='{{$exam->total_points}}' min='0'></td>
                                        <td><input type="text" name="comment[]" value="" class="form-control form-control-sm" placeholder='Comment...'></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row p-2">
                        <div class="col p-2">
                            <button class="btn btn-primary right" type='submit' onclick="xdialog.startSpin()">Submit Marks</button>
                        </div>
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>

@endsection
