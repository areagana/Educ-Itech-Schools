<style>
    table{
        width:100%;
    }
    .table-info{
        background-color:lightblue;
    }
    table,th,tr,td{
        border-collapse:collapse;
        border:1px solid lightgrey;
    }
    tr,th,td{
        padding:2px;
        text-align:center;
    }
    .header{
        border-bottom:1px solid lightgrey;
        padding:3px;
        width:100%;
    }
    .mx-1{
        margin:1px;
    }
    .p-2{
        padding:2px;
    }
    .p-3{
        padding:3px;
    }
    .table-bordered{
        border:1px solid lightgrey;
    }
    .subject-td{
        text-align:left;
    }
</style>

    <div class="row p-0 mx-1">
        <div class="col p-2 bg-white">
                <div class="p-0" id="student-reportcar">
                    <div class="row p-3">
                        <div class="col p-2 header">
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
                            @foreach($subjects as $subject)
                                @php
                                    $total_marks = $subject->assignments->average('total_points');
                                    if($total_marks ==0)
                                    {
                                        $total_marks =1;
                                    }
                                @endphp
                                <tr>
                                    <td class='subject-td'>{{$subject->subject_name}}</td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>