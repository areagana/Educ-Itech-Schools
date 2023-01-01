@include('includes.functions')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$school->school_name}}_{{$form->form_name}}-PDFReports</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <style>
        table,th,tr,td{
            /* border:1px solid;
            border-collapse:collapse; */
            padding:6px;
        }
        thead{
            /* background-color:lightgrey; */
            padding:10px;
        }
        .p-4{
            padding:6px;
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
            width:95% !important;
            margin-top:10px !important;
        }
        .pt-6{
            padding-top:12px;
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
            margin-left:6px;
        }
        .border{
            border:1px solid;
            border-collapse:collapse;
            border-color:black;
        }
        .report-data{
            margin-top:10px !important;
        }
        .water-mark{
            background: url('http://localhost:8080/public/module-icon.jpg');
            background-repeat: repeat-y;
            background-position: center;
            background-attachment: fixed;
            background-size: 100%;
        }
        .report-data table{
            width:100% !important;
            padding:5px !important;
        }
        .page table{
            width:100% !important;
            padding:5px !important;
        }
        .header-border{
            border:4px solid black;
            width:100% !important;
            margin-left:0% !important;
            margin-right:0% !important;
            margin-bottom:10px !important;
        }
        .bold{
            font-weight:bold;
        }
        td .border-less{
            border-top:none !important;
            border-bottom:none !important;
        }
        .text-blue{
            color:blue;
        }
        .form-tutor{
            margin-top:2% !important;
            margin-bottom:2% !important;
        }
        .comment{
            margin-top:4% !important;
            margin-bottom:4% !important;
            padding:6px !important;
        }
        .min-width td{
            width:10px !important;
        }
    </style>
</head>
<body>
    @php
        $bladeHeader = 'reports.headers.'.$school->reg_no;
        $bladeFooter = 'reports.footers.'.$school->reg_no;
    @endphp
    <div class="container-fluid p-0">
        <div class="report p-2">
            @foreach($students as $key => $student)
                <div class="page mt-4 shadow-sm bg-white p-2">
                    @php
                        $results = $student->examresults()->where('exam_id',$exam->id)->get();
                        $subjectCodes =[];
                        $subjectGrades =[];
                    @endphp
                    @include($header)
                    <!-- end report header region -->
                    <div class="p-2">
                        <table class='table' border='1' style='border-collapse:collapse'>
                            <tbody>
                                <tr>
                                    <td width='80px' class='border bold'>NAME</td>
                                    <td width='200px' class='border text-blue'>{{$student->firstname}} {{$student->lastname}}</td>
                                    <td width='100px'></td>
                                    <td width='80px' class='border bold'>ADMIN NO:</td>
                                    <td width='200px' class='border text-blue'>{{$student->admin_no}}</td>
                                </tr>
                                <tr>
                                    <td width='80px' class='border bold'>CLASS</td>
                                    <td width='200px' class='border text-blue'>{{$form->form_name}}</td>
                                    <td width='100px' border='0'></td>
                                    <td width='80px' class='border bold'>PAYCODE</td>
                                    <td width='200px' class='border text-blue'>{{$student->payment_code}}</td>
                                </tr>
                                <tr>
                                    <td width='80px' class='border bold'>STREAM</td>
                                    <td width='200px' class='border text-blue'>{{($stream) ? $stream->name : ''}}</td>
                                    <td width='100px' border='0'></td>
                                    <td width='80px' class='border bold'>TERM</td>
                                    <td width='200px' class='border text-blue'>{{$term->term_name}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-2 form-tutor">
                        <b>CLASS TEACHER:</b> <span class='text-blue'>{{Auth::user()->firstName}} {{Auth::user()->lastName}}</span>
                    </div>
                    <div class="report-data water-mark">
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
                                            $subjectCodes[] = $subject->subject_code;
                                            $subjectGrades[] = gradeMark($marks,$school);
                                        @endphp
                                        <td class='min-width'>{{$subject->subject_code}}</td>
                                        <td class='text-left'>{{$subject->subject_name}}</td>
                                        <td class='min-width'>{{$marks}}</td>
                                        <td class='min-width'>{{gradeMark($marks,$school)}}</td>
                                        <td>{{commentMark($marks)}}</td>
                                        <td class='min-width'></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                    <div class="p-2 comment bold">
                        CLASS TEACHER'S COMMENT: 
                    </div>
                    <div class="p-2 comment bold">
                        HEAD TEACHER'S COMMENT: 
                    </div>
                    <div class="p-2 comment bold">
                        SIGN & STAMP: ...................
                    </div>
                    
                    <div class="p-2 text-center footer">
                        @include($footer)
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>