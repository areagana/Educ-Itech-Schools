@php 
    ini_set('max_execution_time', 3000);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    </style>
</head>
<body>
    <!-- foreach($students as $student) -->
        
            <table class="table border-less">
                <thead >
                    <tr class='border-big'>
                        <th class='text-center' width="150px">
                            <!-- <img src="" alt="" width='200px' height='180px'> -->
                        </th>
                        <th colspan='3'>
                            <h1 class='text-center'>{{$school->school_name}}</h1>
                            <p class="p-2 text-center mt-1">{{$school->address}}</p>
                            <p class="text-center p-2">{{$school->main_contact}}</p>
                            <p class="p-2 text-center">{{$school->email}}</p>
                        </th>
                        <th class='text-center' width="150px">
                            <!-- <img src="" alt="" width='120px' height='125px'>    -->
                        </th>
                    </tr>
                </thead>
            </table>
            <table class='table' border='1' style='border-collapse:collapse'>
                <tbody>
                    <tr>
                        <td width='80px' class='border' style='border-collapse:collapse'>NAME</td>
                        <td width='200px' class='border' style='border-collapse:collapse'>Some name</td>
                        <td width='100px' border='0'></td>
                        <td width='80px' class='border' style='border-collapse:collapse'>ADMIN NO:</td>
                        <td width='200px' class='border' style='border-collapse:collapse'>EDUC2022/22/28392</td>
                    </tr>
                    <tr>
                        <td width='80px' class='border' style='border-collapse:collapse'>CLASS</td>
                        <td width='200px' class='border' style='border-collapse:collapse'>SENIOR 1</td>
                        <td width='100px' border='0'></td>
                        <td width='80px' class='border' style='border-collapse:collapse'>PAYCODE</td>
                        <td width='200px' class='border' style='border-collapse:collapse'>28392893829</td>
                    </tr>
                    <tr>
                        <td width='80px' class='border' style='border-collapse:collapse'>STREAM</td>
                        <td width='200px' class='border' style='border-collapse:collapse'>EAST</td>
                        <td width='100px' border='0'></td>
                        <td width='80px' class='border' style='border-collapse:collapse'>TERM</td>
                        <td width='200px' class='border' style='border-collapse:collapse'>TERM 1 2022</td>
                    </tr>
                </tbody>
            </table>
            
            <!-- <img src="{{asset('avatar.png')}}" alt="" width='80px' height='85px'> -->
            <!-- <div class="p-2 border-big">
                <h2 class="text-center p-2">{{$school->school_name}}</h2>
                <p class="p-2 text-center mt-1">{{$school->address}}</p>
                <p class="text-center p-2">{{$school->main_contact}}</p>
                <p class="p-2 text-center">{{$school->email}}</p>
            </div> -->

            <!-- <img src="{{asset('avatar2.png')}}" alt="" width='80px' height='85px'> -->
    <div class="text-center">
        <table class="table pt-3 ml-3" border='1' style='border-collapse:collapse'>
            <thead>
                <tr>
                    <th>SUBJECT</th>
                    <th>MARKS</th>
                    <th>COMMENT</th>
                    <th>INITIAL</th>
                </tr>
            </thead>
                <tbody>
                    @foreach($level->subjects as $subject)
                    <tr>
                    <!-- php -->
                            <!-- mark = userExamMarks($student,$exam,$subject); -->
                            <!-- total_marks[] = $mark; -->
                        <!-- endphp -->
                        <td>{{$subject->subject_code}} {{$subject->subject_name}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
    <div class="p-2 text-center footer text-danger">
        <p>Please be informed that the page has ended</p>
    </div>
    <!-- endforeach -->
</body>
</html>