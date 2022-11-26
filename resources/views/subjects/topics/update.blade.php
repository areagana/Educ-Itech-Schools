@Extends('layouts.subjectView')
@include('includes.functions')
@section('crumbs')
    {{Breadcrumbs::render('subject',$subject,Auth::user()->school,Auth::user()->school->id)}}
@endsection
@section('subjectContent')
<div class="container-fluid">
    <div class="row p-0">
        <div class="col p-2 border border-primary">
            <h3 class='p-2 border-bottom'>{{$form->form_name}} / {{$subject->subject_name}} - {{$topic->name}}</h3>
            <div class="p-2">
                <form action="{{route('topicMarkUpdate',$topic->id)}}" id="mark-input-form" method='POST'>
                    @csrf
                    <input type="hidden" name="subject_id" value="{{$subject->id}}">
                    <input type="hidden" name="school_id" value="{{$school->id}}">
                    <input type="hidden" name="topic_id" value="{{$topic->id}}">
                    <input type="hidden" name="form_id" value="{{$form->id}}">
                    <input type="hidden" name="card_id" value="{{$card->id}}">
                    <div class="col">
                        <table class="table table-sm">
                            <thead class="table-info">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mark( /3)</th>
                                </tr>
                            </thead>
                            <tbody id='subject-people-results'>
                                @foreach($students as $key=> $member)
                                            @php
                                                $record = userCourseworkMarks($member,$topic);
                                            @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$member->firstName}} {{$member->lastName}}</td>
                                        <input type="hidden" name="user_id[]" value="{{$member->id}}">
                                        <td><input type="text" name="marks[]" value="{{(count($record)>0) ? $record[0]:''}}" class="form-control form-control-sm mark-input" width="40px"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row p-2">
                        <div class="col p-2">
                            <button class="btn btn-primary right" type='submit'>Submit Marks</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection