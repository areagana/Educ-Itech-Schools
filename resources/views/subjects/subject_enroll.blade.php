@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <h5 class="border-bottom p-2">{{$subject->subject_name}} ({{$subject->subject_code}})</h5>
            <div class="card p-2 border-primary">
                    <h5 class="p-2 border-primary border-bottom ">ENROLL STUDENTS TO {{$subject->subject_name}}
                        <span class="right">
                            <input type="text" id="searchSTudent"  class='form-control form-control-sm' onkeyup="SearchItem('searchSTudent','enroll-form-students','tr')" placeholder="Search...">
                        </span>
                    </h5>
                    <form action="{{route('subjEnrollStudent')}}" method='POST' id='subject-enroll-form'>
                        @csrf
                        <input type="hidden" name="subject_id" value="{{$subject->id}}">
                    <table class="table table-sm">
                        <thead class="table-info">
                            <th>
                                <input type="checkbox" name="select_all" id="select_all" onclick="selectAll('selected_student')">
                            </th>
                            <th>Name</th>
                            <td>Class</td>
                            <th>Stream</th>
                        </thead>
                        <tbody id='enroll-form-students'>
                            @foreach($students as $student)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selected_student[]" id="selected_student{{$student->id}}" value="{{$student->id}}">
                                    </td>
                                    <td><label for="selected_student{{$student->id}}">{{$student->firstName}} {{$student->middlename}} {{$student->lastname}}</label></td>
                                    <td>{{$student->form->form_name}}</td>
                                    <td>{{($student->stream) ? $student->stream->name : ''}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </form>
                    <div class="row p-2 border-top border-primary mx-1">
                        <div class="col p-2">
                            <div class="input-group">
                                <select name="school_form" id="school_form" class="custom-select custom-select-sm" form='subject-enroll-form' required>
                                    <option value="">Select Class</option>
                                    @foreach($school->forms as $form)
                                        <option value="{{$form->id}}">{{$form->form_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col p-2">
                            <div class="input-group">
                                <select name="school_stream" id="school_stream" class="custom-select custom-select-sm" form='subject-enroll-form'>
                                    <option value="">Select stream</option>
                                    @foreach($school->streams as $stream)
                                        <option value="{{$stream->id}}">{{$stream->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col p-2">
                            <button class="btn btn-primary btn-sm right" type='submit' form="subject-enroll-form">Enroll into {{$subject->subject_code}}</button>
                        </div>
                    </div>
                </div>
    </div>
@endsection