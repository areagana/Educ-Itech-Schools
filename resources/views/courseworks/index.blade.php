@Extends('layouts.subjectView')
@include('includes.functions')
@section('crumbs')

@endsection
@section('subjectContent')
    <div class="container">
        <div class="row mx-1">
            <div class="col p-2 bg-white">
                <h3 class="p-2 border-bottom">{{$subject->subject_name}} / {{$form->form_name}} - Courseworks</h3>
                <table class="table table-sm table-bordered" id='dataTable'>
                    <thead>
                        <tr>
                            <th colspan='{{3+$topics->count()}}' class='text-center'>{{$form->form_name}} {{$card->subject->subject_name}} AOI RESULTS</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th colspan='{{$topics->count()+1}}' class='text-center'>Topics</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            @foreach($topics as $key=> $topic)
                            <th>TOP {{++$key}}</th>
                            @endforeach
                            <th>Avg</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $key=> $student)
                            @php
                                $data =[];
                            @endphp
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$student->firstName}} {{$student->lastName}}</td>
                                @foreach($topics as $topic)
                                    @php
                                       $results = userCourseWorkMarks($student,$topic);
                                       $mark =   (count($results)>0) ? $results[0] : ''; 
                                       $data[] = $mark;                                 
                                    @endphp
                                    <td>
                                        {{$mark}}
                                    </td>
                                @endforeach
                                <td>{{average($data)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-2 mt-2">
                    <h4 class="p-2 border-bottom">Topics Key</h4>
                    <div class="p-2">
                        @foreach($topics as $key =>$topic)
                            <div class="p-2">
                                TOP {{++$key}} = {{$topic->name}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection