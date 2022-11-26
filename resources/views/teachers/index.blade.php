@Extends('schools.details')
@section('details')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col p-2">
                <div class="card p-2">
                    <h4 class="border-bottom border-primary p-3">
                        {{$school->school_name}} / Teachers
                    </h4>
                    <table class="table table-sm">
                        <thead class="table-info">
                            <tr>
                                <th>Teacher Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id='school-teachers'>
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td>{{$teacher->id}}</td>
                                    <td>{{$teacher->firstName}}</td>
                                    <td>{{$teacher->lastName}}</td>
                                    <td>{{$teacher->email}}</td>
                                    <td>
                                        <span class="inline-block">
                                            <a href="" class="nav-link"><i class="fa fa-eye"></i></a>
                                            <a href="{{route('userView',$teacher->id)}}" class="nav-link"><i class="fa fa-edit"></i></a>
                                            <a href="{{route('teacherEnroll',$teacher->id)}}" class="nav-link" ><i class="fa fa-plus-circle"></i> Enroll</a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$teachers->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection