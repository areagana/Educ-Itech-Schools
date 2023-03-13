@Extends('layouts.users')
@section('content')
<div class="container p-2">
    <div class="row p-0 mx-1">
        <div class="col p-2 bg-white">
            <div class="h4 header p-3">Academic progress report
                <span class="right inline-block h6">
                    <a href="" class="nav-link border btn-outline-primary border-primary report-link">New Model</a>
                    <a href="" class="nav-link border btn-outline-success border-success report-link">Progress Bar</a>
                    <a href="#" class="nav-link border btn-outline-secondary border-secondary" onclick='printPage("student-reportcard")'><i class="fa fa-print"></i> Print</a>
                    <a href="{{route('studentReportPDF')}}" class="nav-link border border-danger btn-outline-danger"> <i class="fa fa-share"></i> PDF</a>
                </span>
            </div>
                <div class="p-0" id="student-reportcard">
                    <div class="row p-3">
                        <div class="col p-2">
                            {{$school->school_name}}
                        </div>
                        <div class="col p-1">
                            Name: {{$user->firstName}} {{$user->lastName}} <br>
                            Gender: <br>
                            Class: {{$form->form_name}} 
                        </div>
                    </div>
                    <table class="table table-sm table-bordered">
                        <thead class="table-info">
                            <tr>
                                <th>Subject</th>
                                <th>Assignments</th>
                                <th>Grade</th>
                                <th>Progress</th>
                                <th>Initial</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($subjects))
                                @foreach($subjects as $subject)
                                    @php
                                        $total_marks = $subject->assignments->average('total_points');
                                        if($total_marks ==0)
                                        {
                                            $total_marks =1;
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{$subject->subject_name}}</td>
                                        <td>{{$subject->assignments->count()}}</td>
                                        <td>{{number_format($subject->assignment_submissions()->where('assignment_submissions.user_id',$user->id)->average('submitted_grade') / $total_marks * 100,0)}}%</td>
                                        <td>
                                            {{$subject->assignment_submissions()->where('assignment_submissions.user_id',$user->id)->count()}} / {{$subject->assignments->count()}}
                                        </td>
                                        <td>
                                            @foreach($subject->users as $member)
                                                @if($member->hasRole('teacher'))
                                                    {{$member->firstName[0]}}.{{$member->lastName[0]}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan='5'><i class='justify-content-center'>You are currently not enrolled in any of the subjects</i></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection