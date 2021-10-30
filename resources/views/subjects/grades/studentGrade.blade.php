@Extends('layouts.subjectView')
@include('includes.functions')
@section('crumbs')
    {{Breadcrumbs::render('subjectGrades',$subject,$subject->id)}}
@endsection
@section('subjectContent')
<div class="row mx-1">
    <div class="col p-2 bg-white">
        <h4 class="header">{{$subject->subject_name}} Grades
            <span class="right">
                <button class="btn btn-danger btn-sm" onclick="printPage('user-grades')"><i class="fa fa-print"></i> Print Grades</button>
            </span>
        </h4>
        <div class="p-0" id='user-grades'>
            <table class="table table-sm">
                <thead class="table-info">
                    <tr>
                        <th colspan='6'> {{$subject->subject_name}} Grades for {{Auth::user()->firstName}} {{Auth::user()->lastName}}</th>
                    </tr>
                    <tr>
                        <th>Assignment Name</th>
                        <th>Close Date</th>
                        <th>Marks</th>
                        <th>Total</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody id="subject-grade">
                    @foreach($assignments as $assignment)
                        @php
                            $submission = $assignment->assignment_submissions()->where('user_id',Auth::user()->id)->get();
                        @endphp
                        <tr>
                            <td>{{$assignment->assignment_name}}</td>
                            <td>{{dateFormat($assignment->close_date,'M jS H:m')}}</td>
                            <td>
                            @if($submission->count() > 0)
                                    @foreach($submission as $sub)
                                        {{$sub->submitted_grade}}
                                        ({{$sub->submitted_grade/$assignment->total_points *100}}%)
                                    @endforeach
                                @else
                                    <span class="text-danger">{{__('*not submitted')}}</span>
                                @endif
                            </td>
                            <td>{{$assignment->total_points}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><b>Total</b></td>
                        <td></td>
                        <td><b>{{$total_marks}} ({{number_format($total_marks/$total_points *100,0)}}%)</b></td>
                        <td><b>{{$total_points}}</b></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection