@php 
    ini_set('max_execution_time', 300);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <title>PDF-Document</title>
    @include('includes.functions')
    <style>
        table,th,tr,td{
            border:1px solid;
            border-collapse:collapse;
            padding:2px;
        }
        thead{
            background-color:lightgrey;
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
    </style>
</head>
<body>
    <div class="p-2">
        {{$school->school_name}} MARKSHEET VIEW 
        <span class="right">
            <a href="{{route('pdf')}}" class="nav-link btn-danger">Convert To Pdf</a>
        </span>
    </div>
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th colspan='{{5 + $level->subjects()->count()}}' class='text-center bg-white'>{{strToUpper($school->school_name)}} MARKSHEET - {{$term->term_name}} {{$term->term_year}}</th>
            </tr>
            <tr>
                <th colspan='{{5 + $level->subjects()->count()}}' class='text-center'>{{strToUpper($form->form_name)}} {{$exam->exam_name}} MARKSHEET</th>
            </tr>
            <tr>
                <th>#</th>
                <th>NAME</th>
                <th>STREAM</th>
                @foreach($level->subjects as $subject)
                    <th>{{$subject->short_name}}</th>
                @endforeach
                <th>TOT</th>
                <th>AVG</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $key=> $student)
                @php
                    $total_marks =[];
                @endphp
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$student->firstname}} {{$student->middlename}} {{$student->lastname}}</td>
                    <td>{{($student->stream) ? $student->stream->name : ''}}</td>
                    @foreach($level->subjects as $subject)
                        @php
                            $mark = userExamMarks($student,$exam,$subject);
                            $total_marks[] = $mark;
                        @endphp
                        <td>{{$mark}}</td>
                    @endforeach
                    <td>{{array_sum($total_marks)}}</td>
                    <td>{{average($total_marks)}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
</body>
</html>