@Extends('layouts.subjectView')
@include('includes.functions')
@section('crumbs')

@endsection
@section('subjectContent')
    <div class="row p-1">
        <div class="col">
            <h3 class="header bg-white">{{$subject->subject_name}} / {{$form->form_name}} Assessments
                <span class="right">
                    <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModalPreview">Enter Marks</button>
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
                                                <th colspan='2'>Exam{{++$key}} ( /{{$exam->total_points}})</th>
                                            @endif
                                        @endforeach
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        @foreach($termExams as $key=> $exam)
                                            @if($exam->examresults()->exists()) <!--check if the relationship has data-->
                                                <th>MK</th>
                                                <th>GD</th>
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
                                            <td>{{$member->firstname}} {{$member->middlename}} {{$member->lastname}}</td>
                                            @foreach($termExams as $key => $exam)
                                                @if($exam->examresults()->exists()) <!--check if the relationship has data-->
                                                    @php
                                                        $mark = userExamMarks($member,$exam,$subject);
                                                        $tot_marks[] = $mark;
                                                    @endphp
                                                    <td>{{$mark}}</td>
                                                    <td>{{gradeMark($mark)}}</td>
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
            <!-- display this if there are active exams -->
                @if($activeExams->count() > 0)
                    <div class="col-md-2">
                        <h4 class="header bg-white">Exams</h4>
                        @foreach($activeExams as $exam)
                            <div class="p-2 bg-white mt-2 shadow-sm school-exam">
                                <a href='{{route("examMarks",[$card->id,$exam->id])}}' class="nav-link">{{$exam->exam_name}}</a>
                            </div>
                        @endforeach
                        <!-- exams key here -->
                        <div class="p-2 border-bottom bg-white h5 mt-2 text-danger">EXAMS KEY</div>
                        @foreach($termExams as $key => $exam)
                            @if($exam->examresults()->exists()) <!--check if the relationship has data-->
                                <div class="p-2 border-bottom bg-white">
                                    <b>Exam{{++$key}}</b> - {{$exam->exam_name}}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
            <!-- onclick="ShowDiv('enter-marks-{{$exam->id}}')" -->
        </div>  
        @foreach($termExams as $exam)
        @endforeach
    </div>

    <!-- Modal -->
  <div class="modal fade right" id="exampleModalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
    <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
      <div class="modal-content-full-width modal-content ">
        <div class=" modal-header-full-width   modal-header text-center">
          <h5 class="modal-title w-100" id="exampleModalPreviewLabel">Material Design  Full Screen Modal</h5>
          <button type="button" class="close " data-dismiss="modal" aria-label="Close">
            <span style="font-size: 1.3em;" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <h1 class="section-heading text-center wow fadeIn my-5 pt-3"> Not for money, but for humanity</h1>
        </div>
        <div class="modal-footer-full-width  modal-footer">
          <button type="button" class="btn btn-danger btn-md btn-rounded" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btn-md btn-rounded">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection