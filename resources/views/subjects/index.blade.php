@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2">
        <div class="p-2 bg-white">
            <h5 class="header p-3">Subjects
                <span class="right p-2 inline-block">
                    <a href="" class="nav-link" @popper(Upload)><i class="fa fa-upload mb-2"></i></a>
                    <a href="" class="nav-link" @popper(Enroll)><i class="fa fa-plus" title='Enrol Users'></i></a>
                    <a href="" class="nav-link mb-3" @popper(Download)><i class="fa fa-download mb-2"></i></a>
                </span>
            </h5>
            <div class="row p-1">
                <div class="col">
                    <input type="text" class="custom-input" placeholder='Search...' id='searchSubject' onkeyup="SearchItem('searchSubject','school-subjects','tr')">
                </div>
            </div>
            <table class="table table-sm">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Users</th>
                        <th>More</th>
                    </tr>
                </thead>
                <tbody id='school-subjects'>
                    @php $sno=1; @endphp
                    @foreach($subjects as $subject)
                        <tr>
                            <td>{{$sno++}}</td>
                            <td>{{$subject->subject_code}}</td>
                            <td>{{$subject->subject_name}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row p-1">
                <div class="col p-2">
                    {{$subjects->links()}}
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection