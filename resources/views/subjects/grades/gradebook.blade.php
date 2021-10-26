@Extends('layouts.subjectView')
@section('crumbs')
    {{Breadcrumbs::render('subjectGrades',$subject,$subject->id)}}
@endsection
@section('subjectContent')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2 bg-white">
                <h4 class="header">{{$subject->subject_name}} Grades</h4>
                <table class="table table-sm table-striped">
                    <thead class="table-info">
                        <tr>
                            <th>User Id</th>
                            <th>Name</th>
                            @php
                                $total_points =[];
                            @endphp
                            @foreach($subject->assignments as $assignment)
                            <th style='width:100px;font-size:10px'>{{$assignment->assignment_name}} <br>({{$assignment->total_points}})</th>
                                @php
                                    $total_points[] = $assignment->total_points;
                                @endphp
                            @endforeach
                            
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="subject-grades-table">
                        @foreach($subject->users as $member)
                <!--check if member has role of a student-->
                            @if($member->hasRole(['student']))
                                @php
                                    $total_marks =[];
                                @endphp
                                <tr>
                                    <td>{{$member->id}}</td>
                                    <td>{{$member->firstName}} {{$member->lastName}}</td>
                                    @foreach($subject->assignments as $assignment)
                                        @php
                                            $submissions = $assignment->assignment_submissions->where('user_id',$member->id);
                                        @endphp
                                        <td>
                        <!--check if a user submitted-->
                                        @if(count($submissions) >= 1)
                                            @foreach($submissions as $sub)
                                        <!--check if submission was marked-->
                                                @if($sub->submitted_grade != null)
                                                    {{number_format($sub->submitted_grade/$assignment->total_points *100)}}%
                                                    @php
                                                        $total_marks[] = $sub->submitted_grade;
                                                    @endphp
                                                @else
                                                </i><a href="{{route('gradeAssignment',$assignment->id)}}" class=""><i class="fa fa-paper-plane" aria-hidden="true"></i> {{__('Grade')}}</a><i>
                                                @endif
                                            @endforeach
                                        @else
                                            <span class="text-danger">{{__('*missing')}}</span>
                                        @endif
                                        </td>
                                    @endforeach
                                    <td>
                                        {{number_format(array_sum($total_marks)/array_sum($total_points) *100)}}%
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection