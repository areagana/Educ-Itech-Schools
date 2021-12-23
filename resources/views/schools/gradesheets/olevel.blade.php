@Extends('schools.details')
@section('details')
    <div class="row p-2">
        <div class="col p-2">
            <h3 class='header'>Olevel Gradesheet
                <span class="right inline-block h6">
                    <input type="hidden"  id="form-marksheet-exams" value="{{$exam->id}}">
                    @foreach($school->forms as $form)
                        <a href="#" class="nav-link form-marksheet" onclick="loadGradesheet({{$form->id}},$(this).text())">{{$form->form_name}}</a>
                    @endforeach
                </span>
            </h3>
            <h5 class="header">
                <span id='exam_name_marksheet'>{{$exam->exam_name}}</span>
                <span class="right">
                    <button class="btn btn-sm btn-danger" onclick="printPage('gradesheet')"><i class="fa fa-print"></i> Print</button>
                </span>
            </h5>
            <div class="p-2 gradesheet" id='gradesheet'>
                    
            </div>
        </div>
    </div>
@endsection