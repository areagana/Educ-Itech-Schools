@Extends('layouts.schoolHome')
@section('crumbs')

@endsection
@include('includes.functions')
<!-- inject a helper function to load reports-->
@inject('helper','App\Http\Controllers\HelperController')
@section('schoolContent')
    <div class="row p-2">
        <div class="col p-2">
            <h1 class="header bg-white report-header">Exam Reports
                <span class="right mx-2">
                    <button class="btn btn-sm btn-danger" onclick="printPage('reports')"><i class="fa fa-print"></i> Print</button>
                </span>
                <span class="right mx-2">
                    <button class="btn btn-sm btn-info" onclick="alert('Develop the emailing function')"><i class="fa fa-share"></i> Email</button>
                </span>
                <span class="right mx-2">
                    <button class="btn btn-sm btn-success" onclick="alert('Build report formats')"><i class="fa fa-share"></i> Change Format</button>
                </span>
            </h1><br>
            <div class="p-2 bg-dark mt-4" id='reports'>
                @foreach($students as $student)
                    <!-- report format for the students basing on their class and level-->
                    <div class="p-2 standard-report bg-white page-break-after mt-2">
                        <div class="row p-2 border-bottom">
                            <!-- school-logo-->
                            <div class="col p-2">
                                <img src="{{asset('school-icon.png')}}" alt="" width="120px" height="120px">
                            </div>
                            <!--school name and title-->
                            <div class="col p-2 justify-content-center">
                                <center>
                                    <div class="h4"><b>{{$school->school_name}}</b>
                                        <div class="h5"><i>{{$school->address}}</i></div>
                                        <div class="h6">+{{$school->main_contact}}</div>
                                    </div>
                                </center>
                            </div>
                            <!--student image if available-->
                            <div class="col p-2">
                                <img src="" alt="" width="120px" height="120px" class='right'>
                            </div>
                        </div>
                    <!-- report subjects and results-->
                        <div class="row p-2">
                            <div class="col p-2">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            @foreach($exams as $key=>$exam)
                                                <th>Exam{{$key}}</th>
                                            @endforeach
                                            <th>Total</th>
                                            <th>Grade</th>
                                            <th>Comment</th>
                                            <th>Initial</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($helper->termSubjects($student->id) as $subject)
                                            <tr>
                                                <td>{{$subject->subject_name}}</td>
                                                @php
                                                    $markArray =[];
                                                @endphp
                                                @foreach($exams as $key=>$exam)
                                                    @php
                                                        $markArray[] = $helper->extractresults($student->id,$subject,$exam);
                                                    @endphp
                                                    <td>
                                                        {{$helper->extractresults($student->id,$subject,$exam)}}
                                                    </td>
                                                @endforeach
                                                <td>{{$helper->sumMarks($markArray)}}</td>
                                                <td>{{$helper->markGrading($helper->sumMarks($markArray))}}</td>
                                                <td>{{$helper->getComment($student->id,$subject,$exam)}}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!--report footer-->
                        <div class="row p-2" style='page-break-after:always'>
                            <div class="col p-2 page-break">
                                Footer or footnote here
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection