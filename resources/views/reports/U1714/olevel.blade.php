<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$school->school_name}}-Reports</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    @include('includes.functions')

    <style>
        table,th,tr,td{
            /* border:1px solid;
            border-collapse:collapse; */
            padding:2px;
        }
        table{
            width:80% !important;
        }
        thead{
            /* background-color:lightgrey; */
            padding:6px;
        }
        .p-4{
            padding:4px;
        }
        .borde-bottom{
            border-bottom:2px solid;
        }
        .text-center{
            text-align:center;
        }
        .bg-white{
            background-color:white;
        }
        .btn-danger{
            background-color:red;
        }
        .right{
            float:right;
        }
        .border-big{
            border-bottom:4px solid;
            width:100% !important;
        }
        .mt-1{
            margin-top:1px;
        }
        .text-danger{
            color:red;
        }
        .footer{
            page-break-after:always;
            bottom:0;
            left:0;
            text-align:center;
            padding:10px;
            width:100% !important;
        }
        .pt-6{
            padding-top:10px;
        }
        .row{
            display:inline-block;
        }
        .row.col{
            display:inline-block;
            float:left;
            width:auto;
        }
        table .border-less thead{
            border:none;
            background-color:white;
        }
        .ml-3{
            margin-left:1px;
        }
        .border{
            border:1px solid;
            border-collapse:collapse;
        }
        .page{
            margin-left:1% !important;
            margin-right:1% !important;
            margin-top:1% !important;
            margin-bottom:4% !important;
            border:4px solid;
            padding:10px;
            height:80% !important;
        }
        .report{
            margin-top:2px !important;
        }
        .header{
            background-color:black !important;
        }
        .inline-block a{
            display:inline-block !important;
        }
    </style>
</head>
<body>
    @php
        $bladeHeader = 'reports.headers.'.$school->reg_no;
        $bladeFooter = 'reports.footers.'.$school->reg_no;
    @endphp
    <div class="container-fluid bg-dark p-0">
        <div class="report p-2">
            @if($students->count() > 0)
                @foreach($students as $key => $student)
                    <div class="page mt-4 shadow-sm bg-white p-2">
                        @php
                            $results = $student->examresults()->where('exam_id',$exam->id)->get();
                            $subjectCodes =[];
                            $subjectGrades =[];
                        @endphp
                        @include($header)
                        <div class="p-2 header-border"></div>
                        <hr>
                        <!-- end report header region -->
                        <div class="p-2">
                            <table class='table' border='1' style='border-collapse:collapse'>
                                <tbody>
                                    <tr>
                                        <td width='80px' class='border bold' style='border-collapse:collapse'>NAME</td>
                                        <td width='200px' class='border text-blue' style='border-collapse:collapse'>{{$student->firstname}} {{$student->lastname}}</td>
                                        <td width='100px' border='0'></td>
                                        <td width='80px' class='border bold' style='border-collapse:collapse'>ADMIN NO:</td>
                                        <td width='200px' class='border text-blue' style='border-collapse:collapse'>{{$student->admin_no}}</td>
                                    </tr>
                                    <tr>
                                        <td width='80px' class='border bold' style='border-collapse:collapse'>CLASS</td>
                                        <td width='200px' class='border text-blue' style='border-collapse:collapse'>{{$form->form_name}}</td>
                                        <td width='100px' border='0'></td>
                                        <td width='80px' class='border bold' style='border-collapse:collapse'>PAYCODE</td>
                                        <td width='200px' class='border text-blue' style='border-collapse:collapse'>{{$student->payment_code}}</td>
                                    </tr>
                                    <tr>
                                        <td width='80px' class='border bold' style='border-collapse:collapse'>STREAM</td>
                                        <td width='200px' class='border text-blue' style='border-collapse:collapse'>{{($stream ) ? $stream->name : ''}}</td>
                                        <td width='100px' border='0'></td>
                                        <td width='80px' class='border bold' style='border-collapse:collapse'>TERM</td>
                                        <td width='200px' class='border text-blue' style='border-collapse:collapse'>{{$term->term_name}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="p-2 form-tutor">
                            <b>CLASS TEACHER:</b> <span class='text-blue'>{{Auth::user()->firstName}} {{Auth::user()->lastName}}</span>
                        </div>
                        <hr>
                        <div class="report-data">
                            <table class="table" border='1' style='border-collapse:collapse'>
                                <thead>
                                    <tr>
                                        <th class='min-width'>CODE</th>
                                        <th class='text-left'>SUBJECT</th>
                                        <th class='min-width'>MARKS</th>
                                        <th class='min-width'>GRADE</th>
                                        <th>COMMENT</th>
                                        <th class='min-width'>INITIAL</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @foreach($level->subjects as $subject)
                                        <tr>
                                            @php
                                                $marks = examMarks($results,$subject);
                                                $subjectCodes[]= [$subject->subject_code =>gradeMarkValue(($marks !=null) ? $marks->marks : '',$school)];
                                                $gradeValue = gradeMarkValue(($marks !=null) ? $marks->marks : '',$school); 
                                                $grade = gradeMark(($marks !=null) ? $marks->marks : '',$school);
                                                $subjectGrades[] =  $gradeValue;                      
                                            @endphp
                                            <td class='min-width'>{{$subject->subject_code}}</td>
                                            <td class='text-left'>{{$subject->subject_name}}</td>
                                            <td class='min-width'>{{($marks !=null) ? $marks->marks : ''}}</td>
                                            <td class='min-width'>{{$grade}}</td>
                                            <td>{{commentMark(($marks !=null) ? $marks->marks : '')}}</td>
                                            <td class='min-width'>{{($marks !=null) ? $marks->user->firstName : ''}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="p-2 comment bold">
                            CLASS TEACHER'S COMMENT: 
                        </div>
                        <hr>
                        <div class="p-2 comment bold">
                            HEAD TEACHER'S COMMENT: 
                        </div>
                        <hr>
                        <div class="p-2 comment bold">
                            SIGN & STAMP:...................
                        </div>
                        <hr>
                        <div class="p-2 text-center footer">
                            @include($footer)
                        </div>
                    </div>
                @endforeach
            @else
                <div class="page mt-4 shadow-sm bg-white p-2 text-center">
                    <h3>No results have been recorded for this exam and class. Please try again.</h3>
                </div>
            @endif
        </div>
    </div>
</body>
</html>