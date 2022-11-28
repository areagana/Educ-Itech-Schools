@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2">
                <div class="card p-2 border-primary">
                    <h5 class="p-2 border-primary border-bottom ">Enroll students to {{$form->form_name}}
                        
                    </h5>
                    <form action="{{route('enrollStudents')}}" method='POST' id='enroll-students-form'>
                        @csrf
                        <input type="hidden" name="form_id" value="{{$form->id}}">
                        <table class="table table-sm">
                            <thead class="table-info">
                                <th>
                                    <input type="checkbox" name="select_all" id="select_all" onclick="selectAll('selected_student')">
                                </th>
                                <th>@sortablelink('admin_no', 'Admin_no')</th>
                                <th>@sortablelink('firstname', 'Firstname')</th>
                                <th>@sortablelink('middlename', 'Middlename')</th>
                                <th>@sortablelink('lastname', 'Lastname')</th>
                                <th>@sortablelink('form_id', 'Class')</th>
                                <th>@sortablelink('stream_id', 'Stream')</th>
                            </thead>
                            <tbody id='enroll-form-students'>
                                @foreach($students as $student)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="selected_student[]" id="selected_student{{$student->id}}" value="{{$student->id}}" class='form-check-input mx-2'>
                                        </td>
                                        <td>{{$student->admin_no}}</td>
                                        <td><label for="selected_student{{$student->id}}">{{$student->firstname}}</label></td>
                                        <td>{{$student->middlename}}</td>
                                        <td>{{$student->lastname}}</td>
                                        <td>{{$student->form->form_name}}</td>
                                        <td>{{($student->stream) ? $student->stream->name : ''}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    <div class="row p-2">
                        <div class="col">
                            {!! $students->appends(Request::except('page'))->render() !!}
                        </div>
                        <!-- <div class="col p-1">
                            <span class="right">Displaying {{$students->count()}} of {{$students->total()}}</span> 
                        </div> -->
                    </div>
                    <div class="row mx-1 border-top border-primary">
                        <div class="col-md-8 p-2">
                            <label for="academic_year">Academic Year</label>
                        </div>
                        <div class="col p-2">
                            <input type="text" name="academic_year" id="academic_year" class="form-control form-control-sm" placeholder='Enter year..' form='enroll-students-form' required>
                        </div>
                    </div>
                    <div class="row p-2 border-top border-primary mx-1">
                        <div class="col p-2">
                            <button class="btn btn-primary btn-sm right" type='submit' form="enroll-students-form">Enroll in {{$form->form_name}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection