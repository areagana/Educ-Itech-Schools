@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <h5 class="border-bottom p-2">{{$subject->subject_name}} ({{$subject->subject_code}})</h5>
            <div class="card p-2 border-primary">
                    <h5 class="p-2 border-primary border-bottom ">Enroll students to {{$subject->subject_name}}
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
                            <th>@sortablelink('firstName', 'First Name')</th>
                            <td>@sortablelink('lastName', 'Last Name')</td>
                            <th>@sortablelink('id', 'User_id')</th>
                        </thead>
                        <tbody id='enroll-form-students'>
                            @foreach($students as $student)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selected_student[]" id="selected_student{{$student->id}}" value="{{$student->id}}">
                                    </td>
                                    <td><label for="selected_student{{$student->id}}">{{$student->firstName}}</label></td>
                                    <td>{{$student->lastName}}</td>
                                    <td>{{$student->id}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </form>
                    <div class="row p-2">
                        <div class="col">
                            {!! $students->appends(Request::except('page'))->render() !!}
                        </div>
                        <div class="col p-1">
                            <span class="right">Displaying {{$students->count()}} of {{$students->total()}}</span> 
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col p-2">
                            <button class="btn btn-primary btn-sm right" type='submit' form="subject-enroll-form">Enroll in {{$subject->subject_code}}</button>
                        </div>
                    </div>
                </div>
    </div>
@endsection