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
            width:100% !important;
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
        }
        .page{
            margin-left:10% !important;
            margin-right:10% !important;
            margin-top:4% !important;
            border:6px solid;
        }
        .report{
            margin-top:8px !important;
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
        <div class="p-2 mx-0 header shadow fixed-top">
            <div class="inline-block">
                <a href="#" class="nav-link text-white">Reports - {{$students->count()}}</a>
                @if($students->count() > 0)
                    <a href="{{route('pdfreportD',[$form->id,$exam->id,($stream)?$stream->id:''])}}" class="nav-link text-white right" target=_blank onclick='xdialog.startSpin()'>Download PDF Version</a>
                @endif
            </div>
        </div>
        <div class="report p-2">
            @if($students->count() > 0)
                @foreach($students as $key => $student)
                    <div class="page mt-4 shadow-sm bg-white p-2">
                        @php
                            $results = $student->examresults()->where('exam_id',$exam->id)->get();
                        @endphp
                        <table class="table border-less">
                            <thead>
                                <tr class='border-big'>
                                    <th class='text-center' width="150px">
                                        <img src="{{asset('Ticked Circle.jpg')}}" alt="" width='200px' height='180px'>
                                    </th>
                                    <th colspan='3'>
                                        <h1 class='text-center'>{{$school->school_name}}</h1>
                                        <p class="p-2 text-center mt-1">{{$school->address}}</p>
                                        <p class="text-center p-2">{{$school->main_contact}}</p>
                                        <p class="p-2 text-center">{{$school->email}}</p>
                                    </th>
                                    <th class='text-center' width="150px">
                                        <img src="{{asset('Ticked Circle.jpg')}}" alt="" width='120px' height='125px'>   
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="p-2 header-border"></div>
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
                        <div class="p-2 form-tutor">
                            <b>CLASS TEACHER:</b> <span class='text-blue'>{{Auth::user()->firstName}} {{Auth::user()->lastName}}</span>
                        </div>
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
                            SIGN & STAMP:...................
                        </div>
                        <div class="p-2 text-center footer">
                            <table class="table border">
                                <thead>
                                    <tr class='border'>
                                        <th colspan='6'>GRADING SCALE</th>
                                    </tr>
                                    <tr class='border'>
                                        @for($i=1;$i< 7; $i++)
                                            <th class='border'>CHECK THIS</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class='border'>
                                        @for($i=1;$i< 7; $i++)
                                            <td class='border'>CHECK THIS</td>
                                        @endfor
                                    </tr>
                                </tbody>
                            </table>
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