@Extends('layouts.subjectView')
@section('crumbs')

@endsection
@section('subjectContent')
    <div class="row p-1">
        <div class="col">
            <h3 class="header bg-white">{{$subject->subject_name}} / {{$subject->form->form_name}} Assessments</h3>
            <div class="p-2 row">

                <div class="col p-2 bg-white">
                    <div class="row px-3">
                        <div class="col-md-4 p-2">
                            <select name="" id="filter-subject-members" class="custom-select" onchange="FilterMembers('filter-subject-members',{{$subject->id}})">
                                <option value="All">All</option>
                                <option value="student">Students</option>
                                <option value="teacher">Teachers</option>
                            </select>
                        </div>
                        <div class="col p-2">
                            <input type="text" class="form-control" id="search-member" onkeyup="SearchItem('search-member','subject-people','tr')" placeholder='Search...'>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col">
                            <table class="table table-sm">
                                <thead class="table-info">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        @foreach($termExams as $key=> $exam)
                                        <th>Exam{{++$key}} ({{$exam->total_points}})</th>
                                        @endforeach
                                        <th>{{__('Total')}}</th>
                                    </tr>
                                </thead>
                                <tbody id='subject-people'>
                                    @foreach($students as $key=> $member)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$member->firstName}} {{$member->lastName}}</td>
                                            @foreach($termExams as $key=> $exam)
                                            <td>Result {{++$key}}</td>
                                            @endforeach
                                            <td>{{__('Tot')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <h4 class="header bg-white">Exams</h4>
                    @foreach($termExams as $exam)
                        <div class="p-2 bg-white mt-2 shadow-sm school-exam">
                            {{$exam->exam_name}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>        

    </div>
@endsection