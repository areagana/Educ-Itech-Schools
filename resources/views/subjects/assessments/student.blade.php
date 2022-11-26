@Extends('layouts.subjectView')
@section('crumbs')

@endsection
@section('subjectContent')
    <div class="row p-1">
        <div class="col">
            <h3 class="header">{{$subject->subject_name}} / {{$subject->level->name}} Assessments</h3>
            <div class="p-2 row">
                <div class="col p-2 bg-white">

                </div>
                <div class="col-md-3 p-2 ">
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