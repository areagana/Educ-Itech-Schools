@Extends('layouts.subjectView')
@include('includes.functions')
@section('crumbs')

@endsection
@section('subjectContent')
    <div class="row p-1">
        <div class="col">
            <h3 class="header bg-white">{{$subject->subject_name}} / {{$subject->form->form_name}} Assessments
                <span class="right">
                    <button class="btn btn-sm btn-outline-primary">Enter Marks</button>
                    <button class="btn btn-sm btn-outline-primary">Marks</button>
                </span>
            </h3>
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
                                            @if($exam->examresults()->exists()) <!--check if the relationship has data-->
                                                <th>Exam{{++$key}} ( /{{$exam->total_points}})</th>
                                            @endif
                                        @endforeach
                                        <th>{{__('Total')}}</th>
                                        <th>{{__('Avg')}}</th>
                                    </tr>
                                </thead>
                                <tbody id='subject-people'>
                                    @foreach($students as $key=> $member)
                                        @php
                                            $tot_marks =[];
                                        @endphp
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$member->firstName}} {{$member->lastName}}</td>
                                            @foreach($termExams as $key => $exam)
                                                @if($exam->examresults()->exists()) <!--check if the relationship has data-->
                                                    @php
                                                        $result = $member->examresults()->where('subject_id',$subject->id)->where('exam_id',$exam->id)->get();
                                                        $tot_marks[] = userExamMarks($result)[0];
                                                        var_dump($result);
                                                    @endphp
                                                <td>{{userExamMarks($result)[0]}}</td>
                                                @endif
                                            @endforeach
                                            <td>{{array_sum($tot_marks)}}</td>
                                            <td>{{average($tot_marks)}}</td>
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
                            @if(!$subject->examresults()->exists())
                                <a href='#' class="right nav-link" onclick="ShowDiv('enter-marks-{{$exam->id}}')"><i class="fa fa-plus-circle"></i> Marks</a>
                            @else
                                <a href='#' class="right nav-link" onclick="ShowDiv('update-marks-{{$exam->id}}')"><i class="fa fa-edit"></i> Marks</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>  
        @foreach($termExams as $exam)      
        <div class="bg-white shadow border border-primary floating-div hidden enter-marks enter-marks-{{$exam->id}} p-0">
            <div class="p-2 bg-info text-white h5">
                Enter Marks ({{$exam->exam_name}})
                <button  class="right px-2 btn-sm btn btn-danger" onclick="Close('enter-marks-{{$exam->id}}')">&times;</button>
            </div>
            <div class="p-2">
                    <div class="row px-3">
                        <div class="col-md-4 p-2">
                            <select name="" id="filter-subject-members" class="custom-select" onchange="FilterMembers('filter-subject-members',{{$subject->id}})">
                                <option value="All">All</option>
                                <option value="student">Students</option>
                                <option value="teacher">Teachers</option>
                            </select>
                        </div>
                        <div class="col p-2">
                            <input type="text" class="form-control" id="search-member-res{{$exam->id}}" onkeyup="SearchItem('search-member-res{{$exam->id}}','subject-people-results{{$exam->id}}','tr')" placeholder='Search...'>
                        </div>
                    </div>
                    <div class="row p-1">
                        <form action="{{route('markStore')}}" id="mark-input-form" method='POST'>
                            @csrf
                            <input type="hidden" name="subject_id" value="{{$subject->id}}">
                            <input type="hidden" name="school_id" value="{{$school->id}}">
                            <input type="hidden" name="term_id" value="{{$term->id}}">
                            <input type="hidden" name="exam_id" value="{{$exam->id}}">
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
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$member->firstName}} {{$member->lastName}}</td>
                                                <input type="hidden" name="user_id[]" value="{{$member->id}}">
                                                <td><input type="text" name="marks[]" class="form-control form-control-sm mark-input" width="40px"></td>
                                                <td><input type="text" name="comment[]"  class="form-control form-control-sm" placeholder='Comment...'></td>
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

    <!-- update exam results-->
        <div class="bg-white shadow border border-primary floating-div hidden enter-marks update-marks-{{$exam->id}} p-0">
            <div class="p-2 bg-info text-white h5">
                Enter Marks ({{$exam->exam_name}})
                <button  class="right px-2 btn-sm btn btn-danger" onclick="Close('update-marks-{{$exam->id}}')">&times;</button>
            </div>
            <div class="p-2">
                    <div class="row px-3">
                        <div class="col-md-4 p-2">
                            <select name="" id="filter-subject-members" class="custom-select" onchange="FilterMembers('filter-subject-members',{{$subject->id}})">
                                <option value="All">All</option>
                                <option value="student">Students</option>
                                <option value="teacher">Teachers</option>
                            </select>
                        </div>
                        <div class="col p-2">
                            <input type="text" class="form-control" id="search-member-res{{$exam->id}}" onkeyup="SearchItem('search-member-res{{$exam->id}}','subject-people-results{{$exam->id}}','tr')" placeholder='Search...'>
                        </div>
                    </div>
                    <div class="row p-1">
                        <form action="{{route('markUpdate')}}" id="mark-input-form" method='POST'>
                            @csrf
                            <input type="hidden" name="subject_id" value="{{$subject->id}}">
                            <input type="hidden" name="school_id" value="{{$school->id}}">
                            <input type="hidden" name="term_id" value="{{$term->id}}">
                            <input type="hidden" name="exam_id" value="{{$exam->id}}">
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
                                                        $result = $member->examresults()->where('subject_id',$subject->id)->where('exam_id',$exam->id)->get();
                                                        $mark = userExamMarks($result)[0];
                                                        $comment = userExamMarks($result)[1];
                                                    @endphp
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$member->firstName}} {{$member->lastName}}</td>
                                                <input type="hidden" name="user_id[]" value="{{$member->id}}">
                                                <td><input type="text" name="marks[]" value="{{$mark}}" class="form-control form-control-sm mark-input" width="40px"></td>
                                                <td><input type="text" name="comment[]" value="{{$comment}}" class="form-control form-control-sm" placeholder='Comment...'></td>
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
        @endforeach
    </div>
@endsection